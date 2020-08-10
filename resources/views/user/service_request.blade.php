@extends('layouts.app')
@section('content')

<section class="user-service-request mt-4">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="register-block">
                    <h2>My Service Requests</h2>
                </div>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card " >
                    <div class="card-header">

                    </div>
                    {{-- <div class="card-header">
                        <form action="/filter" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row form-group">
                                <div class="col-md">
                                </div>
                                <div class="col-md">
                                </div>
                                @if($start != 0  && $end != 0)
                                    <div class="col-md" id="start_date">
                                        <input type="date" name="start_date" id="start-date" value="{{ $start }}" class="form-control">
                                    </div>
                                    <div class="col-md" id="end_date">
                                        <input type="date" name="end_date" id="end-date" value="{{ $end }}" onchange="clickSubmit()" class="form-control">
                                    </div>
                                @else
                                    <div class="col-md" id="start_date">
                                    </div>
                                    <div class="col-md" id="end_date">
                                    </div>
                                @endif
                                <div class="col-md">
                                @if($filter)
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="0" selected>No Filter</option>
                                        <option disabled>-Service Type-</option>
                                        @foreach($services as $service)
                                            @if($filter == $service->id)
                                                <option value="{{ $service->id }}" selected>{{ $service->srvcName }}</option>
                                            @else
                                                <option value="{{ $service->id }}">{{ $service->srvcName }}</option>
                                            @endif
                                        @endforeach
                                        <option disabled>-Others-</option>
                                        @if($filter == "date")
                                            <option value="date" selected>Date</option>
                                        @else
                                            <option value="date">Date</option>
                                        @endif
                                    </select>
                                @else
                                    <select name="filter" id="filter" class="form-control">
                                        <option disabled selected>Filter By</option>
                                        <option disabled>-Service Type-</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->srvcName }}</option>
                                        @endforeach
                                        <option disabled>-Others-</option>
                                        <option value="date">Date</option>
                                    </select>
                                @endif
                                </div>
                                <input type="submit" id="self_submit" style="display: none;">
                            </div>
                        </form>
                    </div> --}}
                    @include('layouts.message')
                    <div class="card-body admin-db">
                        @if(count($serviceRequests) == 0)
                            <h2 style="text-align: center"><b>No services created</b></h2>
                        @else
                        
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sr ID</th>
                                    <th scope="col">Sr Type</th>
                                    <th scope="col">Sr Date</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            
                            <tbody>


                                @foreach ($serviceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{$serviceRequest->srId}}</th>
                                        <td style="text-transform:uppercase">{{$serviceRequest->service->srvcName}}
                                        <td> {{date('d-m-Y', strtotime($serviceRequest->srRecievedDateTime))}}  </td>
                                        <td>{{$serviceRequest->patient->patFirstName}} {{$serviceRequest->patient->patLastName}}</td>
                                        <td>
                                            @if ($serviceRequest->paymentStatus == true)
                                                Paid
                                            @else
                                                Not Paid
                                            @endif
                                            
                                        </td>
                                        <td> 

                                            <a href="/service-request/{{Auth::user()->id}}/{{$serviceRequest->srId}}" class="btn btn-maroon btn-sm">View Details</a>

                                        </td>

                                    </tr>

                                    
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="card-footer"></div>
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