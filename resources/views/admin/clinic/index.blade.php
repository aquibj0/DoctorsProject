@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>Clinics</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <div class="row">
                        <div class="col-md">
                            <p class="maroon location-hidden"><b> “Pan right or rotate screen to view all details”
                            </b></p>
                        </div>
                        <div class="col-md">

                            <span style="float: right">
                                <a href="/admin/clinic/create" class="btn btn-md btn-maroon">Add new clinic</a>
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
                    @if($clinics)
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. </th>
                                <th scope="col">Clinic Name</th>
                                <th scope="col">Clinic Mobile & LandLine</th>
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
                                    <td>{{ $clinic->clinicAddressLine1 }}
                                        @if($clinic->clinicAddressLine2)
                                            <br>
                                            {{ $clinic->clinicAddressLine2 }}
                                        @endif
                                        <br>
                                        {{ $clinic->clinicCity }}, {{ $clinic->clinicDistrict }}
                                        <br>
                                        {{ $clinic->clinicState }}, {{ $clinic->clinicCountry }}, {{ $clinic->clinicPincode }}
                                    </td>
                                    <td>
                                        <a href="/admin/clinic/edit/{{ $clinic->id }}" class="btn btn-md btn-maroon">Edit</a>
                                        <a href="#" class="btn btn-maroon btn-md" data-toggle="modal" data-target="#{{ 'deleteClinic'.$loop->iteration }}">Delete</a>  
                                   
                                        <div class="modal fade" id="{{ 'deleteClinic'.$loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Delete Clinic</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <form action="{{ url('/admin/clinic/'.$clinic->id.'/delete') }}" method="post">
                                                        @csrf
                                                        
                                                        <div class="modal-body">
                                                            <h5 > Confirm Delete <b class="maroon">{{ $clinic->clinicName }} ?</b></h5>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure?')">Delete </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h2>No Clinic added!</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>




</div>
@endsection