@extends('admin.layouts.app')

@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="container">
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
                            <div class="col-md-4">
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
                                        <tr>
                                            <th scope="row">Booking Date</th>
                                            <td>{{ $srvcReq->srRecievedDateTime }}</td>
                                        </tr>        

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
                                            <th scope="row">Customer ID</th>
                                            <td>{{ $srvcReq->patient->patId }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Registered User Name</th>
                                            <td>{{ $srvcReq->patient->user->userFirstName }} {{ $srvcReq->patient->user->userLastName }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <h5 class="maroon mb-3"><u><b>PATIENT HISTORY</b></u></h5>
                                <div class="patient-history">
                                    <h5 class="maroon"><b>No History FOund</b></h5>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5 class="maroon mb-3"><u><b>PAYMENT STATUS</b></u></h5>
                                <table class="table table-responsive table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Payment Status</th>
                                            <td>Paid</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Payment Mode</th>
                                            <td>Lorem</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Payment Time</th>
                                            <td>lorem</td>
                                        </tr> 
                                        <tr>
                                            <th scope="row">Payment ID</th>
                                            <td>loremIpsums565</td>
                                        </tr>        
                                    </tbody>
                                </table>

                                <div class="group-buttons float-right mt-4">
                                    <a href="/admin/service-request/{{$srvcReq->id}}/respond" class="btn btn-maroon btn-md">Respond</a>
                                    <a href="/admin/service-request/{{$srvcReq->id}}/download-report" class="btn btn-maroon btn-md">Download Reports</a>
                                </div>
                            </div>

                            <div class="col-md-6"></div>
                            <div class="col-md-6 mt-3">
                                
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