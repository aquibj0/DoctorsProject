@extends('admin.layouts.app')

@section('content')


{{-- IF service request is regarding ASK A QUESTION --}}
@if (!empty($srvcReq->askQuestion))
    <div class="container mt-2">
        @include('layouts.message')
        <div class="row">
            
            <div class="col-md-6">
                <div class="register-block">
                    <h2>RESPONSE ASK A DOCTOR</h2>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('layouts.message')
                <div class="row">
                    <div class="col-md-6">
                        
                        <h5 class="maroon"><b><u>PATIENT DETAILS</u> </b></h5>
                        <div class="table-responsive">
                            <table class="table  table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Service Req ID</th>
                                        <td>{{$srvcReq->srId}}</td>        
                                    </tr>
                                    <tr>
                                        <th>Patient Name</th>
                                        <td>{{$srvcReq->patient->patFirstName}} {{$srvcReq->patient->patLastName}}</td>        
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Patient Age</th>
                                        <td>{{ $srvcReq->patient->patAge}}</td> 
                                    </tr>

                                    <tr>
                                        <th scope="row">Patient Gender</th>
                                        <td>{{ $srvcReq->patient->patGender }}</td>
                                    </tr>    
                                    </tr>
                                </tbody>
                            
                            </table>
                        </div>

                        <h5 class="maroon"><b><u>PATIENT BACKGROUND</u> </b></h5>
                        <div class="mb-3" style="padding:8px;max-height:200px; overflow-y:scroll;border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->askQuestion->aaqPatientBackground}}
                        </div>

                        <h5 class="maroon"><b><u>PATIENT QUESTION</u> </b></h5>
                        <div style="padding:8px;max-height:200px; overflow-y:scroll;border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->askQuestion->aaqQuestionText}}
                        </div>



                        
                        <div class="mt-4 buttons">
                            <a href="{{ url('/admin/service-request/'.$srvcReq  ->id.'/download-report') }}" class="btn btn-maroon btn-md mb-3">Download Report</a>                                                  
                        </div>

                    </div>
                    <div class="col-md-6" style="border:1px solid #000; padding: 15px">
                        <h5 class="maroon"><b><u>DOCTOR'S RESPONSE</u> </b></h5>

                        {{-- Check if doctor has been assigned to this service request --}}
                        @if (isset($srvcReq->srAssignedIntUserId))
                            
                            @if ($srvcReq->askQuestion->aaqDocResponse != null)
                                <p>{{$srvcReq->askQuestion->aaqDocResponse}}</p> 
                            
                            @else
                                @if(isset($srvcReq->adminDoctor) && Auth::user()->id == $srvcReq->adminDoctor->id)
                                    <form  method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
                                    {{ csrf_field() }}
                        
                                    <div class="form-row mt-1">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="response" id="response" cols="30" rows="15" placeholder="Response" required></textarea>
                                        </div>
                                        <div class="text-center" style="width:100%">
                                            @if(isset($srvcReq->adminDoctor) && Auth::user()->id == $srvcReq->adminDoctor->id)
                                            <button type="submit" style="width:100%" class="btn btn-maroon" >SUBMIT</button>
                                            @endif
                                        </div>
                                    </form>
                                @else
                                    <h2>No Response from Doctor</h2>
                                @endif
                            @endif

                        @else
                            <h2><b>Doctor Not Assigned. Kindly Assign</b></h2>
                        @endif

                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- IF service request is regarding VIDEO CALL WITH DOCTOR --}}

@elseif(!empty($srvcReq->videoCall))
<div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="register-block">
                <h2>RESPONSE - {{strtoupper($srvcReq->service->srvcName)}}</h2>
            </div>
            
        </div>    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.message')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mb-3">

                        <h5 class="maroon"><b><u>PATIENT DETAILS</u> </b></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Service Req ID</th>
                                        <td>{{$srvcReq->srId}}</td>        
                                    </tr>
                                    <tr>
                                        <th>Patient Name</th>
                                        <td>{{$srvcReq->patient->patFirstName}} {{$srvcReq->patient->patLastName}}</td>        
                                    </tr>
                                    
                                    <tr>
                                        <th>Patient Age</th>
                                        <td>{{$srvcReq->patient->patAge}}</td>        
                                    </tr>
                                    <tr>
                                        <th>Patient Gender</th>
                                        <td>{{$srvcReq->patient->patGender}}</td>        
                                    </tr>
                                        
                                </tbody>
                                
                            </table>
                        </div>
                        <h5 class="maroon"><b><u>PATIENT BACKGROUND</u> </b></h5>
                        <div class="mb-3" style="padding:8px;max-height:200px; overflow-y:scroll; border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->patient->patBackground}}
                        </div>

                        @php
                            $prescriptions = App\PatientDocument::where([
                                ['service_request_id', '=', $srvcReq->id],
                                ['documentUploadedBy', '!=', $srvcReq->user->id],
                            ])->get();
                        @endphp


                    @if (isset($prescriptions))
                        <h5 class="mt-3 maroon"><b><u>DOCTOR'S PRESCRIPTIONS</u> </b></h5>
                        <small>*Uploaded by doctor</small>
                        <div class="table-responsive">
                            <table class="mt-2 table  table-bordered">
                                <thead class="thead-dark">
                                    <th scope="col">File Name</th>
                                    <th scope="col">File Description</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Action</th>


                                </thead>

                                <tbody>
                                    @foreach ($prescriptions as $prescription)
                                        <tr>
                                            <td>{{$prescription->documentFileName}}</td>
                                            <td>{{$prescription->documentDescription}}</td>
                                            <td>{{$prescription->documentUploadedBy}}</td>
                                            @if($srvcReq->srStatus != "Cancelled")
                                            <td><a href="{{url('downloadDoc/'.$prescription->id)}}" class="btn btn-maroon btn-sm mb-2">Download</a>
                                                <form action="/upload-documents/delete/{{$prescription->id}}" method="post">


                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @if($srvcReq->srStatus != "CLOSED")
                                                    <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure?')">Delete </button>
                                                    @endif 
                                                </form>
                                            {{-- <a href="{{url('downloadDoc/'.$prescription->id)}}" class="btn btn-maroon btn-sm mb-2">Delete</a></td> --}}
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{-- {{$prescriptions}} --}}
                                </tbody>
                            </table>
                        </div>
                    @endif


                        <div class="mt-4 buttons">
                            
                            <a href="{{ url('/admin/service-request/'.$srvcReq->id.'/download-report') }}" class="btn btn-maroon btn-md mb-3">Download Report</a>                                          
                            @if(count($prescriptions) < 1)
                            <a href="#"  data-toggle="modal" id="uploadDocumentButton" data-target="#uploadPrescription" class="btn btn-maroon btn-md mb-3">Upload Prescription</a>    
                            @endif
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function(){
                                    var x = "{{ $errors->has('documentType') }}"
                                    if(x === "1" || "{{$errors->has('documentFileName')}}" == "1" || "{{$errors->has('documentDescription')}}" == "1"){
                                        document.getElementById("uploadDocumentButton").click();
                                    }
                                });
                            </script>
                            <div class="modal fade" id="uploadPrescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Upload Prescription</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/upload-documents/{{$srvcReq->id}}" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body ">
                                                
                                            
                                                
                                                <div class="form-group ">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="documentType">Document Type</label>
                                                            <select name="documentType" id="documentType" class="form-control @error('documentType') is-invalid @enderror" required>
                                                                <option value="Report">Report</option>
                                                                <option value="Prescription">Prescription</option>
                                                            </select>

                                                            
                            
                                                            @error('documentType')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="documentDescription">Document Description</label>
                                                            <input name="documentDescription" id="documentDescription" placeholder="Document Description" class="form-control @error('documentDescription') is-invalid @enderror"  value="{{ old('documentDescription') }}" autocomplete="documentDescription" autofocus>
                                                            
                            
                                                            @error('documentDescription')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="documentFileName">Upload Document</label>
                                                            <input id="documentFileName" type="file" placeholder="Document Filename" class="form-control @error('documentFileName') is-invalid @enderror" name="documentFileName" value="{{ old('documentFileName') }}" required autocomplete="documentFileName" autofocus>
                            
                                                            @error('documentFileName')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    {{-- <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="documentDate">Date of Report/Prescription</label>
                                                            <input id="documentDate" type="date" placeholder="Document Filename" class="form-control @error('documentDate') is-invalid @enderror" name="documentDate" value="{{ old('documentDate') }}" required autocomplete="documentDate" autofocus>
                            
                                                            @error('documentDate')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div> --}} 
                                                    <input type="hidden" name="documentUploadedBy" id="documentUploadedBy" value="{{Auth::user()->firstName.' '.Auth::user()->lastName }}">
                                                    <input type="hidden" name="service_request_id" id="service_request_id" value="{{$srvcReq->id}}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-maroon btn-sm">Save</button>
                                            </div>
                                            
                                        </form>


                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>

                
                <div class="col-md-5" >

                        <div  >

                            <div style="border:1px solid #000; padding: 15px">
                                    <h5 class="maroon"><b><u>DOCTOR COMMENTS INTERNAL</u> </b></h5>

                            @if ($srvcReq->videoCall->vcDocInternalNotesText == null)
                                @if(isset($srvcReq->adminDoctor) && Auth::user()->id == $srvcReq->adminDoctor->id)
                                <form action="/admin/internalnotes/{{$srvcReq->videoCall->id}}" method="POST">
                                    @csrf
                                    <textarea  class="form-control" name="vcDocInternalNotesText" id="vcDocInternalNotesText" cols="30" rows="10">{{ old('vcDocInternalNotesText') }}</textarea>
                                    @if(isset($srvcReq->adminDoctor) && Auth::user()->id == $srvcReq->adminDoctor->id)
                                    <div class="form-group text-center mb-0">
                                        <button type="submit" class=" mt-2 btn btn-maroon">Save</button>
                                    </div>
                                    @endif
                                </form>
                                @else
                                <h2>No internal notes added</h2>
                                @endif
                            @else
        
                                <form action="/admin/internalnotes/{{$srvcReq->videoCall->id}}" method="POST">
                                    @csrf
                                    <textarea  class="form-control" name="vcDocInternalNotesText" id="vcDocInternalNotesText" cols="30" rows="10">{{$srvcReq->videoCall->vcDocInternalNotesText}}</textarea>
                                    @if(isset($srvcReq->adminDoctor) && Auth::user()->id == $srvcReq->adminDoctor->id)
                                    <div class="form-group text-center mb-0">
                                        @if($srvcReq->srStatus != "CLOSED")
                                        <button type="submit" class=" mt-2 btn btn-maroon">Update</button>
                                        @endif
                                    </div>
                                    @endif
                                </form>
                            @endif
                            
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    @if( $srvcReq->srStatus != "CLOSED" && count($prescriptions) == 1)
                    <div class="row mt-3">
                        <div class="col-md">
                            <a href="/admin/service-request/{{$srvcReq->id}}/close" class="btn btn-maroon btn-md mb-3" style="width: 100%">Submit</a>
                        </div>
                        <div class="col-md">
                            <a href="/admin" class=" text-center mb-3 btn btn-md btn-maroon" style="width: 100%">Back</a>
                        </div>
                    </div>
                    {{-- @elseif(count($prescriptions) > 1)
                    <a href="/admin/service-request/{{$srvcReq->id}}/close" class="btn btn-maroon btn-md mb-3" style="width: 100%" onclick="return false;" disabled>Submit 2</a>
                    <div class="text-center mt-3">
                        <a href="{{ url()->previous() }}" class=" text-center mt-4 mb-2"><u>Back</u></a>
                    </div> --}}
                    @else
                        <div class="row mt-3">
                            <div class="col-md">
                                <a href="/admin/service-request/{{$srvcReq->id}}/close" class="btn btn-maroon btn-md mb-3" style="width: 100%" onclick="return false;">Submit</a>
                            </div>
                            <div class="col-md">
                                <div class="text-center" style="width:100%; ">
                                    <a href="{{ url('/admin') }}" class=" text-center mb-2 btn btn-md btn-maroon" style="width: 100%">Back</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container">
                @if(count($prescriptions) < 1)
                *Submit atleast One prescription to CLOSE the Service Request.
                @endif
            </div>
        </div>
    </div>
</div>   

                                    {{-- @if ($srvcReq->videoCall->vcDocInternalNotesText == null)
                                        <form action="/admin/internalnotes/{{$srvcReq->videoCall->id}}" method="POST">
                                            @csrf
                                            <textarea  class="form-control" name="vcDocInternalNotesText" id="vcDocInternalNotesText" cols="30" rows="10">{{ old('vcDocInternalNotesText') }}</textarea>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class=" mt-2 btn btn-maroon">Save</button>
                                            </div>
                                        </form>
                
                                    @else
                
                                        <form action="/admin/internalnotes/{{$srvcReq->videoCall->id}}" method="POST">
                                            @csrf
                                            <textarea  class="form-control" name="vcDocInternalNotesText" id="vcDocInternalNotesText" cols="30" rows="10">{{$srvcReq->videoCall->vcDocInternalNotesText}}</textarea>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class=" mt-2 btn btn-maroon">Update</button>
                                            </div>
                                        </form>
                                    @endif
                                    
                
                                    
                            </div>
                        </div>
                        @endif

                    @endif


                </div>
            </div>
        </div>
    </div>    --}}


{{-- If Service Request Regarding The Clinic Booking  --}}
{{-- @elseif(!empty($srvcReq->clinicAppointment))

    Nothing to response  --}}
@endif
@endsection