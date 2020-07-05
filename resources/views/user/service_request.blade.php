@extends('layouts.app')
@section('content')

<section class="user-service-request mt-4">
    <div class="container">
        <div class="row">

            @if (!empty($serviceRequests))
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="col-md-4">
                        <a href="/service-request/{{Auth::user()->id}}/{{$serviceRequest->srId}}">
                            <div class="card mb-4" >
                                <div class="card-body">
                                    <h4><b>Service</b> <span>: {{$serviceRequest->srId}}</span></h4> 
                                    
                                    <h4><b>Service Request ID</b> <span>: {{$serviceRequest->service_id}}</span></h4> 
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
    </div>
</section>

{{-- {{$serviceRequest}} --}}


@endsection 