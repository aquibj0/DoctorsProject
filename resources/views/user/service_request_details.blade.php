@extends('layouts.app')
@section('content')

    <section class="mt-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="maroon">Service Request ID : <span>{{ $serviceRequests->srId }}</span> </p>
                            <p class="maroon">Service Request Type : <span>{{ $serviceRequests->service->srvcName }}</span> </p>
                            <p class="maroon">Service Time : <span>{{ $serviceRequests->srRecievedDateTime }}</span> </p>
                            <p class="maroon">Service Department : <span>{{ $serviceRequests->srDepartment }}</span> </p>                            
                            <p class="maroon">Patient ID : <span>{{ $serviceRequests->patient->patId }}</span> </p>
                            <p class="maroon">Patient Name: <span>{{ $serviceRequests->patient->patFirstName }} {{ $serviceRequests->patient->patLastName }}</span> </p>
                            <p class="maroon">Patient Age : <span>{{ $serviceRequests->patient->patAge }} Years</span> </p>
                            <p class="maroon">Patient Background: <span>{{ $serviceRequests->patient->patBackground }} Years</span> </p>
                            
                            
                            @if ($serviceRequests->service_id === 1)
                                <p class="maroon">Patient Question : <span>{{$serviceRequests->askQuestion->aaqQuestionText     }}</span></p>
                                
                                @if ($serviceRequests->askQuestion->aaqDocResponse === null)
                                    <p class="maroon">Doctor Response : Not Responded Yet </p>
                                @else

                                    <p class="maroon">Doctor Response : <span> {{$serviceRequests->askQuestion->aaqDocResponse}} </span> </p>
                                @endif
                            
                            @endif


                            <h4></h4>
                        </div>
                        <div class="col-md-4 " style="border-left:1px solid #000">

                            <h3 class="maroons"><b>More Actions</b></h3>

                            <div class="btn-grouped">
                                @if ($serviceRequests->service_id === 1 || $serviceRequests->service_id === 2)
                                    <a href="#" class="btn btn-maroon btn-sm mb-2">Upload Document</a>     
                                @endif
                                
                                <a href="#" class="btn btn-maroon btn-sm mb-2">View Response</a>
                                <a href="#" class="btn btn-maroon btn-sm mb-2">Request Cancellation</a>    
                            </div>
                        </div>
                    </div>
                    
                    

                    
                    
                    {{-- @if ()
                        
                    @endif --}}
                </div>
            </div>
        </div>
    </section>



@endsection