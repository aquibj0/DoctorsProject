@extends('admin.layouts.app')

@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mt-2">
                <div class="register-block">
                    <h2>SERVICE REQUEST DETAILS</h2>
                </div>
            </div>

                   
            {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div> --}}
            <div class="col-md-12" >

                @include('layouts.message')

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <h5 class="maroon mb-3"><u><b>SERVICE DETAILS</b></u></h5>

                                <table class="table  table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Service Req ID</th>
                                            <td>{{ $srvcReq->srId }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Service Type</th>
                                            <td>{{ $srvcReq->service->srvcName }}</td>
                                            
                                        </tr>


                                        @if (isset($srvcReq->clinicAppointment))
                                            <tr>
                                                <th scope="row">Clinic Name</th>
                                                <td>{{$srvcReq->clinicAppointment->clinic->clinicName }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Clinic Contact</th>
                                                <td>
                                                    {{$srvcReq->clinicAppointment->clinic->clinicMobileNo }}
                                                    {{$srvcReq->clinicAppointment->clinic->clinicLandLineNo }}
                                                </td>
                                            </tr>        
    
                                            <tr>
                                                <th scope="row">Clinic Location</th>
                                                <td>
                                                    {{$srvcReq->clinicAppointment->clinic->clinicAddressLine1 }},     
                                                    {{$srvcReq->clinicAppointment->clinic->clinicAddressLine2 }},    
                                                    {{$srvcReq->clinicAppointment->clinic->clinicCity }},
                                                    {{$srvcReq->clinicAppointment->clinic->clinicDistrict}},
                                                    {{$srvcReq->clinicAppointment->clinic->clinicState }},
                                                    {{$srvcReq->clinicAppointment->clinic->clinicCountry }}, 
                                                    {{$srvcReq->clinicAppointment->clinic->clinicPincode }} 



                                                </td>
                                            </tr>
                                        @else
                                    @endif



                                        <tr>
                                            <th scope="row">Booking Date</th>
                                            
                                            <td>{{date('d-m-Y ', strtotime($srvcReq->srRecievedDateTime))}} </td>
                                        </tr>        

                                        <tr>
                                            <th scope="row">Sr Status</th>
                                            
                                            <td>{{$srvcReq->srStatus}}</td>
                                        </tr>  

                                    </tbody>
                                </table>

                                {{-- Payment Status --}}

                                <h5 class="maroon mb-3"><u><b>PAYMENT STATUS</b></u></h5>

                                @php
                                    $paymentDetails = App\Payment::where('service_req_id', '=', $srvcReq->id)->first();
                                @endphp
                                
                                @if ($srvcReq->paymentStatus == true)
                                    <table class="table  table-bordered">
                                        <tbody>
                                        
                                            <tr>
                                                <th scope="row">Payment Status</th>
                                                <td>Paid</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Payment ID</th>
                                                <td>{{$paymentDetails->payment_transaction_id}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Payment Time</th>
                                                <td>{{ date('H:i | d-m-Y ', strtotime($paymentDetails->created_at))}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Payment Mode</th>
                                                <td>Razorpay</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Payment Amount</th>
                                                <td>{{ '₹ '.$paymentDetails->payment_amount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table  table-bordered">
                                        <tbody>
                                            @if ($srvcReq->failedPayment()->exists())
                                                <tr>
                                                    <th scope="row">Payment Status</th>
                                                    <td>{{$srvcReq->failedPayment->description}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Payment ID</th>
                                                    <td>{{$srvcReq->failedPayment->payment_transaction_id}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Payment Amount</th>
                                                    <td>{{$srvcReq->failedPayment->payment_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Error Code</th>
                                                    <td>{{$srvcReq->failedPayment->code}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Time</th>
                                                    <td>
                                                        {{ date('H:i | d-m-Y ', strtotime($srvcReq->failedPayment->created_at))}}
                                                    </td>
                                                </tr>

                                            @else
                                                <tr>
                                                    <th scope="row">Payment Status</th>
                                                    <td>Payment Not Completed</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    
                                   

                                @endif


                                <h5 class="maroon mb-3"><u><b>RESPONSE</b></u></h5>



                                <table class="table  table-bordered">
                                    <tbody>

                                        @if ($srvcReq->srAssignedIntUserId == null)
                                            <tr>
                                                <th scope="row">Assign Doctor</th>
                                                <td>Not Assigned</td>
                                            </tr>


                                        @else
                                            <tr>
                                                <th scope="row">Assign Doctor</th>
                                                <td>Dr. {{$srvcReq->adminDoctor->firstName}} {{$srvcReq->adminDoctor->lastName}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Responded By</th>
                                                <td>
                                                    @if ($srvcReq->srStatus == 'CLOSED') 
                                                        Dr. {{$srvcReq->adminDoctor->firstName}} {{$srvcReq->adminDoctor->lastName}}

                                                    @else
                                                        Not Responded yet
                                                    @endif    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Response Time</th>
                                                
                                                <td> 
                                                    @if ($srvcReq->srStatus == 'CLOSED')
                                                        {{date('H:i | d-m-Y ', strtotime($srvcReq->srResponseDateTime))}} 
                                                    @else
                                                        Not Responded yet
                                                    @endif
                                                    
                                                </td>
                                            </tr>        
    
                                            <tr>
                                                <th scope="row">Invoice No.</th>
                                                <td>To Be Done</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Invoice Date</th>
                                                <td>To Be Done</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Response Uploaded</th>
                                                <td>To Be Done</td>
                                            </tr>  

                                        @endif
                                        
                                       
                                  

                                    </tbody>
                                </table>


                            </div>
                           
                        
                            <div class="col-md-3">
                                <div class="text-center"> 

                                    @if (isset($srvcReq->patient->patPhotoFileNameLink))
                                        <img style="max-width:80%" class="img-fluid  mt-3" src="{{asset('storage/patPhotoFileNameLink/'.$srvcReq->patient->patPhotoFileNameLink)}}" alt="">
                                    @else
                                        <img style="max-width:60%" class="img-fluid mt-3" src="{{asset('image/user-profile.png')}}" alt="">

                                    
                                    @endif
                                    
                                </div>
                            </div>



                            {{-- Patient Details --}}
                            <div class="col-md">

                                <h5 class="maroon mb-3"><u><b>PATIENT DETAIL</b></u></h5>
                                <table class="table table-bordered ">
                                    <tbody >
                                        <tr>
                                            <th scope="row"> Name</th>
                                            <td>{{ $srvcReq->patient->patFirstName }} {{ $srvcReq->patient->patLastName }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> Age</th>
                                            <td>{{ $srvcReq->patient->patAge}}</td> 
                                        </tr>

                                        <tr>
                                            <th scope="row"> Gender</th>
                                            <td>{{ $srvcReq->patient->patGender }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row"> Address</th>
                                            <td>{{ $srvcReq->patient->patAddrLine1 }}, {{ $srvcReq->patient->patAddrLine2 }} , 
                                                    {{ $srvcReq->patient->patCity }}, {{ $srvcReq->patient->patDistrict }},
                                                    {{ $srvcReq->patient->patState }}, {{ $srvcReq->patient->patCountry }}, 
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Mobile</th>
                                            <td>{{ $srvcReq->patient->patMobileNo }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $srvcReq->patient->patEmail }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th scope="row">Customer ID</th>
                                            <td>{{ $srvcReq->patient->patId }}</td>
                                        </tr> --}}

                                        <tr>
                                            <th scope="row">Reg. User ID</th>
                                            <td>{{ $srvcReq->patient->user->userEmail }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Reg. User Name</th>
                                            <td>{{ $srvcReq->patient->user->userFirstName }} {{ $srvcReq->patient->user->userLastName }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row"> Purpose</th>

                                            @php
                                                $department = App\Department::select('department_name')->where('id', '=', $srvcReq->srDepartment)->first();
                                            @endphp

                                            <td>{{ $department->department_name }}</td>
                                        </tr>
                                        <tr >
                                            <th scope="row"> Background</th>
                                            <td>
                                                <div style="max-height:70px; overflow:hidden; overflow-y:scroll;padding-right:8px;">
                                                    {{ $srvcReq->patient->patBackground }}
                                                </div>
                                            </td>
                                        </tr>
                                        @if (isset($srvcReq->askQuestion))
                                            <tr >
                                                <th scope="row"> Question</th>
                                                <td>
                                                    <div style="max-height:70px; overflow:hidden; overflow-y:scroll;padding-right:8px;">
                                                        {{ $srvcReq->askQuestion->aaqQuestionText }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>    
                                </table>      

                                
                                    <div class="group-buttons float-right mt-4">
                                        {{-- @if($srvcReq->srStatus != "Cancelled") --}}
                                        @if (!$srvcReq->clinicAppointment)
                                        {{-- @if (!empty($srvcReq->askQuestion)) --}}
                                            {{-- Show Respond Button where service request is AAQ --}}
                                            
                                            <a href="/admin/service-request/{{$srvcReq->id}}/respond" class="btn btn-maroon btn-md mb-2 mr-1 ml-1">
                                                @if(Auth::user()->category == "doc")
                                                Respond
                                                @else
                                                View Response
                                                @endif
                                            </a>                                
                                            <a href="/admin/service-request/{{$srvcReq->id}}/download-report" class="btn btn-maroon btn-md mb-2 mr-1 ml-1">Download Reports</a>
                                        {{-- @elseif(!empty($srvcReq->videoCall)) --}}
        
                                            {{--  --}}

                                        {{-- @endif --}}
                                        @endif
                                        {{-- @endif --}}
                                        @if (isset($srvcReq->clinicAppointment) &&  $srvcReq->srAssignedIntUserId != null)
                                            <a href="/admin/service-request/{{$srvcReq->id}}/close" class="btn btn-maroon btn-md mb-2 mr-1 ml-1" disabled>Close Request</a>
                                        @endif
                                        <a href="/admin" class="btn btn-maroon btn-md mb-2 mr-1 ml-1">Back</a>
                                        {{-- <span class="small"></span> --}}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection 