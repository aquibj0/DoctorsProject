@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>admin Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <div class="row">
                        <div class="col-md">

                            <span style="float: right">
                                <a href="/admin/clinic/create" class="btn btn-md btn-success">Add new clinic</a>
                            </span>
                            {{-- <span style="float: right">
                                <select name="filter" id="filter" class="form-control">
                                    <option disabled>-Payment Status-</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Not Paid</option>
                                    <option disabled>-Service Type-</option>
                                    <option value="AAQ">AAQ</option>
                                    <option value="VED">VED</option>
                                    <option value="VTD">VTD</option>
                                    <option value="CLI">CLI</option>
                                </select>
                            </span> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Clinic Name<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Clinic Mobile & LandLine<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Clinic Address</th>
                                {{-- <th scope="col">P</th> --}}
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinics as $clinic)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $clinic->clinicName }}</td>
                                    <td>Mobile: {{ $clinic->clinicMobileNo }}                                        
                                        @if($clinic->clinicLandLineNo)
                                            <br>
                                            Landline:{{ $clinic->clinicLandLineNo }}
                                        @endif
                                    </td>
                                    <td>{{ $clinic->addressLine }}
                                        @if($clinic->addressLine2)
                                            <br>
                                            {{ $clinic->addressLine2 }}
                                        @endif
                                        <br>
                                        {{ $clinic->clinicCity }}, {{ $clinic->clinicDistrict }}
                                        <br>
                                        {{ $clinic->clinicState }}, {{ $clinic->clinicCountry }}, {{ $clinic->clinicPincode }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/clinic/'.$clinic->id.'/delete') }}" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection