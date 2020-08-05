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

                                <table class="table table-responsive table-bordered">
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
        
                                        {{-- <div class="col-md-4">
                                            <h5 class="maroon mb-3"><u><b>APPOINTMENT DETAILS</b></u></h5>
                                            <p class="maroon"><b>No History Found</b></p>
                                        </div> --}}
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
                                    <table class="table table-responsive table-bordered">
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
                                                <td>{{ date('d-m-Y ', strtotime($paymentDetails->created_at))}}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table table-responsive table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Payment Status</th>
                                                <td>Not Paid</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                   

                                @endif


                                <h5 class="maroon mb-3"><u><b>RESPONSE</b></u></h5>



                                <table class="table table-responsive table-bordered">
                                    <tbody>

                                        @if ($srvcReq->srAssignedIntUserId == null)
                                            <tr>
                                                <th scope="row">Assign Doctor</th>
                                                <td>
                                                    
                                                        Not Assigned
                                                
                                                </td>
                                            </tr>


                                        @else

                                            <tr>
                                                <th scope="row">Assign Doctor</th>
                                                <td>Dr. {{$srvcReq->adminDoctor->firstName}} {{$srvcReq->adminDoctor->lastName}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Responded By</th>
                                                <td>To Be Done</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Response Time</th>
                                                
                                                <td>{{date('d-m-Y ', strtotime($srvcReq->srRecievedDateTime))}} </td>
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
                           
                        
                            <div class="col-md-4">

                                <div class="text-center"> 

                                    @if (isset($srvcReq->patient->patPhotoFileNameLink))
                                        <img style="max-width:80%" class="img-fluid  mt-3" src="{{asset('storage/patPhotoFileNameLink/'.$srvcReq->patient->patPhotoFileNameLink)}}" alt="">
                                    @else
                                        <img style="max-width:60%" class="img-fluid mt-3" src="{{asset('image/user-profile.png')}}" alt="">

                                    
                                    @endif
                                    
                                </div>
                               

                            </div>

                            <div class="col-md-4">

                                    <h5 class="maroon mb-3"><u><b>PATIENT DETAIL</b></u></h5>
                                <table class="table table-bordered table-responsive">
                                    <tbody >
                                        <tr>
                                            <th scope="row">Patient Name</th>
                                            <td>{{ $srvcReq->patient->patFirstName }} {{ $srvcReq->patient->patLastName }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Patient Age</th>
                                            <td>{{ $srvcReq->patient->patAge}}</td> 
                                        </tr>

                                        <tr>
                                            <th scope="row">Patient Gender</th>
                                            <td>{{ $srvcReq->patient->patGender }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Patient Address</th>
                                            <td>{{ $srvcReq->patient->patAddrLine1 }}, {{ $srvcReq->patient->patAddrLine2 }} , 
                                                    {{ $srvcReq->patient->patCity }}, {{ $srvcReq->patient->patDistrict }},
                                                    {{ $srvcReq->patient->patState }}, {{ $srvcReq->patient->patCountry }}, 
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Contact Mobile</th>
                                            <td>{{ $srvcReq->patient->patMobileNo }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Contact Email</th>
                                            <td>{{ $srvcReq->patient->patEmail }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th scope="row">Customer ID</th>
                                            <td>{{ $srvcReq->patient->patId }}</td>
                                        </tr> --}}

                                        <tr>
                                            <th scope="row">Registered User ID</th>
                                            <td>{{ $srvcReq->patient->user->userEmail }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Registered User Name</th>
                                            <td>{{ $srvcReq->patient->user->userFirstName }} {{ $srvcReq->patient->user->userLastName }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Patient Purpose</th>
                                            <td>{{ $srvcReq->srDepartment }}</td>
                                        </tr>
                                        <tr style="max-height:100px; overflow:hidden; overflow-y:scroll">
                                            <th scope="row">Patient Background</th>
                                            <td>{{ $srvcReq->patient->patBackground }}</td>
                                        </tr>
                                    </tbody>    
                                </table>      

                                    @if (!$srvcReq->clinicAppointment)
                                        <div class="group-buttons float-right mt-4">
                                            
                                            {{-- @if (!empty($srvcReq->askQuestion)) --}}
                                                {{-- Show Respond Button where service request is AAQ --}}
                                                
                                                <a href="/admin/service-request/{{$srvcReq->id}}/respond" class="btn btn-maroon btn-md">
                                                    @if(Auth::user()->category == "doc")
                                                    Respond
                                                    @else
                                                    View Response
                                                    @endif
                                                </a>                                
                                                <a href="/admin/service-request/{{$srvcReq->id}}/download-report" class="btn btn-maroon btn-md">Download Reports</a>
                                            {{-- @elseif(!empty($srvcReq->videoCall)) --}}
            
                                                {{--  --}}

                                            {{-- @endif --}}

                                        </div>
                                   @endif
                            </div>
                        </div>
                    </div>
                </div>

               

                
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="maroon mb-3"><b><u>SERVICE REQUEST DETAILS</u></b></h4>

                                <table class="table table-bordered table-responsive mb-4">
                                    <thead class="thead-dark">
                                        <th scope="col">Sr Id</th>
                                        <th scope="col">Sr Type</th>
                                        <th scope="col">Sr Time</th>
                                        <th scope="col">Sr Department</th>
                                        <th scope="col">Sr Response Time</th>
                                        <th scope="col">Assigned Doctor</th>
                                        <th scope="col">Status</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $srvcReq->srId }}</td>
                                            <td>{{ $srvcReq->service->srvcName }}</td>
                                            <td>{{ $srvcReq->srRecievedDateTime }}</td>
                                            <td>{{ $srvcReq->srDepartment }}</td>
                                            
                                            @if ($srvcReq->srResponseDateTime === null)
                                                <td>Not Responded yet</td>
    
                                            @else
                                                <td>
                                                    {{ $srvcReq->srResponseDateTime}}
                                                
                                                </td>
                                            @endif
                                            @if ($srvcReq->srAssignedIntUserId === null)
                                                <td>Doctor</td>
                                            @endif
                                            <td>{{$srvcReq->srStatus}}</td>
                                        </tr>
                                    </tbody>
    
                                </table>






                                

                                <table class="table table-bordered table-responsive ">
                                    <thead class="thead-dark">
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Patient Gender</th>
                                        <th scope="col">Patient Age</th>
                                        <th scope="col">Patient Background</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $srvcReq->patient->patId }}</td>
                                            <td>{{ $srvcReq->patient->patFirstName }} {{ $srvcReq->patient->patLastName }}</td>
                                            <td>{{ $srvcReq->patient->patGender }}</td>
                                            <td>{{ $srvcReq->patient->patAge}}</td> 
                                            <td>{{ $srvcReq->askQuestion->aaqPatientBackground }}</td> 
                                        </tr>

                                    </tbody>

                                </table>



                                <h4 class="maroon mb-3"><u><b>SERVICE DETAILS</b></u></h4>

                                @if ($srvcReq->service_id === 1)
                                    <table class="table table-bordered table-responsive mb-4">
                                        <thead class="thead-dark">
                                            <th scope="col">Patient Background</th>
                                            <th scope="col">Patient Question</th>
                                            <th scope="col">Doctor Response</th>
                                            <th scope="col">Prescription by doctor</th>
                                        </thead>
        
                                        <tbody>
                                            <td>{{ $srvcReq->askQuestion->aaqPatientBackground }}</td>
                                            <td>{{ $srvcReq->askQuestion->aaqQuestionText }}</td>
                                            @if ($srvcReq->askQuestion->aaqDocResponse != null)
                                                <td>Responded at {{ $srvcReq->srResponseDateTime}}</td>
                                            @else
                                                <td>Not Responded</td>
                                            @endif
                                            @if ($srvcReq->askQuestion->aaqDocResponseUploaded != null)
                                                <td>{{ $srvcReq->askQuestion->aaqDocResponseUploaded }}</td>                                            
                                            @endif
                                        </tbody>
        
                                    </table>
                                @endif




                                @php
                                    $patDocs = App\PatientDocument::where('service_request_id', '=', $srvcReq->id)->get();
                                @endphp
                                @if (isset($patDocs))
                                    <h4 class="maroon mb-3"><u><b>PATIENT DOCUMENTS</b></u></h4>
                                    <table class="table table-bordered table-responsive mb-4">
                                        <thead class="thead-dark">
                                            <th scope="col">File Type</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">File Date</th>
                                            <th scope="col">Upload Date</th>
                                            <th scope="col">Action</th>
                                        </thead>
        
                                        <tbody>
                                            @foreach ($patDocs as $patDoc)
                                                <tr>
                                                    <td>{{ $patDoc->documentType }}</td>
                                                    <td>{{ $patDoc->documentFileName }} </td>
                                                    <td>{{ $patDoc->documentDescription }}</td>
                                                    <td>{{ $patDoc->documentDate }}</td>
                                                    <td>{{ $patDoc->documentUploadDate }}</td>
                                                    <td> <a href="#" class="btn btn-maroon btn-sm">View</a> </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
        
                                    </table>
                                @endif  



                                <div class="btn-groupped mt-3 float-right">
                                    <a href="#" class="btn btn-maroon btn-sm">Upload Document</a>
                                    <a href="#" class="btn btn-maroon btn-sm">Send Reminder</a>
                                </div>

                            </div>
                        </div>




                        
                        

                    </div>
                </div>      --}}
            
            </div>
        </div>
    </div>


</section>




@endsection 