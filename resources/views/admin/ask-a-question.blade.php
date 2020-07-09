@extends('admin.layouts.app')

@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="container">
            <div class="row">
                   <div class="col-md-8 mt-4">
                        <div class="register-block">
                            <h2>Response - Ask a doctor</h2>
                        </div>
                   </div>

                   
                    {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div> --}}
                    <div class="col-md-12" >

                        @include('layouts.message')
                        
                        <div class="row">
                            <div class="col-md-12 mt-2">
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
                                                            {{-- <br>
                                                            <a href="#" data-toggle="modal" data-target="#patientResponse" class="btn btn-maroon btn-sm">View Response</a> --}}
                                                        
                                                        </td>
                                                    @endif
                                                    {{-- <td>{{ $serviceRequests->srResponseDateTime}}</td> --}}
                                                    @if ($srvcReq->srAssignedIntUserId === null)
                                                        <td>Doctor</td>
                                                    @endif
                                                    <td>{{$srvcReq->srStatus}}</td>
                                                </tr>
                                            </tbody>
            
                                        </table>






                                        <h4 class="maroon mb-3"><u><b>PATIENT DETAILS</b></u></h4>

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
                                                {{-- <tr>    
                                                    <th scope="row">Patient background</th>
                                                    <td>{{ $srvcReq->patient->patBackground}}</td>        
                                                </tr> --}}
                                                {{-- <tr>    
                                                    <th scope="row">Patient background</th>
                                                          
                                                </tr>
                                                <tr>
                                                    <th scope="col">Department</th>
                                                    <td> {{$srvcReq->srDepartment}} </td>
                                                </tr>
                                                <tr>    
                                                    <th scope="row">Patient Question</th>
                                                    <td>{{ $srvcReq->askQuestion->aaqQuestionText}}</td>        
                                                </tr>
                                                @if ($srvcReq->askQuestion->aaqDocResponse != null)
                                                    <tr>    
                                                        <th scope="row">Response</th>
                                                        <td>{{ $srvcReq->askQuestion->aaqDocResponse}}</td>        
                                                    </tr>
                                                @endif --}}

                                        </table>



                                        <h4 class="maroon mb-3"><u><b>SERVICE DETAILS</b></u></h4>

                                        @if ($srvcReq->service_id === 1)
                                            <table class="table table-bordered table-responsive mb-4">
                                                <thead class="thead-dark">
                                                    <th scope="col">Patient Background</th>
                                                    <th scope="col">Patient Question</th>
                                                    <th scope="col">Doctor Response</th>
                                                    <th scope="col">Prescription by doctor</th>
                                                    {{-- <th scope="col">Patient</th> --}}
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
                                                    {{-- <th scope="col">Sr. No</th> --}}
                                                    <th scope="col">File Type</th>
                                                    <th scope="col">File Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">File Date</th>
                                                    <th scope="col">Upload Date</th>
                                                    <th scope="col">Action</th>
                                                    {{-- <th scope="col">Patient Address</th> --}}
                                                    {{-- <th scope="col">Patient</th> --}}
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

                                            {{-- <a href="#" class="btn btn-maroon btn-sm">Upload Document</a> --}}

                                            {{-- <a href="#" class="btn btn-maroon btn-sm">Respo</a> --}}
                                        </div>

                                    </div>
                                </div>




                              
                              

                            </div>


                            @if ($srvcReq->askQuestion->aaqDocResponse === null)
                                <div class="col-md-4 mt-4">
                                    <div class="form mt-4 mt-2">
                                        <form method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
                                            {{ csrf_field() }}
            
                                            <div class="form-row mt-1">
                                                <div class="form-group col-md-12">
                                                    <textarea class="form-control" name="response" id="response" cols="30" rows="5" placeholder="Response"></textarea>
                                                </div>
                                            </div>
            
                                            <div class="form-row">
                                                <div class="mb-3">
                                                    <h5 class="maroon MB-3"><b>UPLOAD PRESCRIPTION</b></h5>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <span><h5>Do you want to upload?</h5>
                                                    <input type="checkbox" value="1" name="document_upload" id="document_upload" placeholder="Yes"><label for="document_upload">YES</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" value="0" name="document_upload" id="document_upload" placeholder="No"><label for="document_upload">NO</label>
                                                    </span>
                                                    {{-- <input type="file" class="form-control" > --}}
                                                </div>
                                            </div>
            
                                            <button type="submit" class="btn btn-primary btn-lg" style="width:100%">SUBMIT</button>
                                        </form>
                                    </div>
                                </div>
                            @endif



                        





                            
                        </div>     
                    
                    </div>
                </div>
    </div>


</section>




@endsection