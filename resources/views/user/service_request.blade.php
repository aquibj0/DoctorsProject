@extends('layouts.app')
@section('content')

<section class="user-service-request mt-4">

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="register-block">
                    <h2>My Service Requests</h2>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    @include('layouts.message')
                    <div class="card-body">
                        @if(count($serviceRequests) == 0)
                            <h2 style="text-align: center"><b>No services created</b></h2>
                        @else
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sr ID</th>
                                    <th scope="col">Sr Type</th>
                                    <th scope="col">Sr Date Time</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            
                            <tbody>


                                @foreach ($serviceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{$serviceRequest->srId}}</th>
                                        <td style="text-transform:uppercase">{{$serviceRequest->service->srvcName}}
                                        <td> {{$serviceRequest->srRecievedDateTime}} </td>
                                        <td>{{$serviceRequest->patient->patFirstName}} {{$serviceRequest->patient->patLastName}}</td>
                                        <td> 

                                            <a href="/service-request/{{Auth::user()->id}}/{{$serviceRequest->srId}}" class="btn btn-maroon btn-sm">View Details</a>

                                        </td>

                                    </tr>

                                    
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                   
            </div>
        </div>
    </div>
    
    
    
    
    {{-- <div class="container">
        <div class="row">

            @if (!empty($serviceRequests))
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="col-md-4">
                        <a href="/service-request/{{Auth::user()->id}}/{{$serviceRequest->srId}}">
                            <div class="card mb-4" >
                                <div class="card-body">
                                    <h4><b>Service</b> <span>: </span></h4> 
                                    
                                    <h4><b>Service Request ID</b> <span>: </span></h4> 
                                    @php
                                        
                                    $patient = App\Patient::where('id', '=', $serviceRequest->patient_id)->first();
    
                                    @endphp
                                    <h4><b>Patient</b> <span>: {{$patient->patFirstName }} {{$patient->patLastName }} </span></h4> 
                                    
                                    
                                    <h4 class="mb-0"><b>Status</b> <span>: {{$serviceRequest->srStaus}} Open</span></h4> 
                                
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                @else
                <h2 class="maroon"><b>No Request Found</b></h2>
            @endif
            
            
        </div>
    </div> --}}
</section>

{{-- {{$serviceRequest}} --}}


@endsection 