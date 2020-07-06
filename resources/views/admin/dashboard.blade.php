@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>admin Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No.</th>
                                <th scope="col">Sr Type</th>
                                <th scope="col">Sr Date</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($servReq))
                                @foreach ($servReq as $serviceReq)
                                    <tr>
                                        <th scope="row"> {{$serviceReq->srId}} </th>
                                        <td>{{$serviceReq->service->srvcName}}</td>
                                        <td>{{$serviceReq->srRecievedDateTime}}</td>
                                        <td>{{$serviceReq->srStatus}}</td>
                                        <td>{{$serviceReq->patient->patFirstName}} {{$serviceReq->patient->patLastName}}</td>
                                        <td><a href="{{ url('/admin/service-request/'.$serviceReq->id) }}" class="btn btn-maroon btn-sm">Open</a>                                        </td>
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