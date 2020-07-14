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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <span style="float: right">
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
                            </span>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Sr Type<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Sr Date<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($servReq))
                                @foreach ($servReq as $serviceReq)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox">
                                            {{$serviceReq->srId}} </th>
                                        <td>{{$serviceReq->service->srvcName}}</td>
                                        <td>{{$serviceReq->srRecievedDateTime}}</td>
                                        <td> 
                                            @if ($serviceReq->paymentStatus == true)
                                            Paid
                                            @else
                                            Not Paid
                                            @endif
                                        
                                        </td>
                                        <td>{{$serviceReq->patient->patFirstName}} {{$serviceReq->patient->patLastName}}</td>
                                        <td>
                                            
                                            <a href="{{ url('/admin/service-request/'.$serviceReq->id) }}" class="btn btn-maroon btn-sm">View Details</a> 
                                            
                                            @if ($serviceReq->paymentStatus == true)
                                                <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/respond') }}" class="btn btn-maroon btn-sm">Response</a>  
                                                <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/download-report') }}" class="btn btn-maroon btn-sm">Download Report</a>                                          
                                            @endif
                                           
                                            
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection