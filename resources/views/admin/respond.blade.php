@extends('admin.layouts.app')

@section('content')


{{-- IF service request is regarding ASK A QUESTION --}}
@if (!empty($srvcReq->askQuestion))
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-6">
                <div class="register-block">
                    <h2>RESPONSE ASK A DOCTOR</h2>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
    
                        <h5 class="maroon"><b><u>PATIENT DETAILS</u> </b></h5>
                        <table class="table table-responsive table-bordered">
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

                        <h5 class="maroon"><b><u>PATIENT BACKGROUND</u> </b></h5>
                        <div class="mb-3" style="padding:8px;max-height:200px; overflow-y:scroll;border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->patient->patBackground}}
                        </div>

                        <h5 class="maroon"><b><u>PATIENT QUESTION</u> </b></h5>
                        <div style="padding:8px;max-height:200px; overflow-y:scroll;border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->askQuestion->aaqQuestionText}}
                        </div>



                        
                        <div class="mt-4 buttons">
                            <a href="{{ url('/admin/service-request/'.$srvcReq  ->id.'/download-report') }}" class="btn btn-maroon btn-md">Download Report</a>                                                  
                        </div>

                    </div>
                    <div class="col-md-6" >
                        <div style="border:1px solid #000; padding: 15px">
                            <h5 class="maroon"><b><u>DOCTOR'S RESPONSE</u> </b></h5>
                            @if ($srvcReq->askQuestion->aaqDocResponse != null)
                                <p>{{$srvcReq->askQuestion->aaqDocResponse}}</p> 
        
                            @else
                                <form  method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
                                    {{ csrf_field() }}
                        
                                    <div class="form-row mt-1">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="response" id="response" cols="30" rows="15" placeholder="Response"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-maroon" >SUBMIT</button>
                                    </div>
                                </form>
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
                <h2>RESPONSE - VIDEO CALL WITH DOCTOR</h2>
            </div>
        </div>
        
    </div>    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 mb-3">

                    <h5 class="maroon"><b><u>PATIENT DETAILS</u> </b></h5>
                    <table class="table table-responsive table-bordered">
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

                    <h5 class="maroon"><b><u>PATIENT BACKGROUND</u> </b></h5>
                    <div class="mb-3" style="padding:8px;max-height:200px; overflow-y:scroll; border:1px solid rgb(97, 13, 13);"> 
                        {{$srvcReq->patient->patBackground}}
                    </div>

                    @php
                        $prescriptions = App\PatientDocument::where([
                            ['service_request_id', '=', $srvcReq->id],
                            ['documentUploadedBy', '=', 'Doctor']
                        ])->get();
                    @endphp


                    @if (isset($prescriptions))
                        <h5 class="mt-3 maroon"><b><u>PATIENT PRESCRIPTIONS</u> </b></h5>
                        <small>*Uploaded by doctor</small>
                        <table class="mt-2 table table-responsive table-bordered">
                            <thead class="thead-dark">
                                <th scope="col">File Name</th>
                                <th scope="col">File Description</th>
                                <th scope="col">Uploaded By</th>


                            </thead>

                            <tbody>
                                @foreach ($prescriptions as $prescription)
                                    <tr>
                                        <td>{{$prescription->documentFileName}}</td>
                                        <td>{{$prescription->documentDescription}}</td>
                                        <td>{{$prescription->documentUploadedBy}}</td>
                                    </tr>
                                @endforeach
                                {{-- {{$prescriptions}} --}}
                            </tbody>
                        </table>
                    @endif


                    <div class="mt-4 buttons">
                        
                        <a href="{{ url('/admin/service-request/'.$srvcReq->id.'/download-report') }}" class="btn btn-maroon btn-md">Download Report</a>                                          
                            
                        <a href="#"  data-toggle="modal" data-target="#uploadPrescription" class="btn btn-maroon btn-md">Upload Prescription</a>    
                        
                        <div class="modal fade" id="uploadPrescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upoad Prescription</h5>
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
                                                        <label for="documentType">Docuement Type</label>
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
                                                        <label for="documentDescription"> Document Description</label>
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
                                                        <label for="documentFileName">Upload Docuement</label>
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
                                                <input type="hidden" name="documentUploadedBy" id="documentUploadedBy" value="Doctor">
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

                    <div style="border:1px solid #000; padding: 15px">
                            <h5 class="maroon"><b><u>DOCTOR COMMENTS INTERNAL</u> </b></h5>


                            @if ($srvcReq->videoCall->vcDocInternalNotesText == null)
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
            </div>
        </div>
    </div>
</div>   




@elseif(!empty($srvcReq->clinicAppointment))


@endif
@endsection