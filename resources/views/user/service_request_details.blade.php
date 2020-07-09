@extends('layouts.app')
@section('content')

    <section class="mt-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('layouts.message')

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
                                        <td>{{ $serviceRequests->srId }}</td>
                                        <td>{{ $serviceRequests->service->srvcName }}</td>
                                        <td>{{ $serviceRequests->srRecievedDateTime }}</td>
                                        <td>{{ $serviceRequests->srDepartment }}</td>
                                        
                                        @if ($serviceRequests->srResponseDateTime === null)
                                            <td>Not Responded yet</td>

                                        @else
                                            <td>
                                                {{ $serviceRequests->srResponseDateTime}}
                                                <br>
                                                <a href="#" data-toggle="modal" data-target="#patientResponse" class="btn btn-maroon btn-sm">View Response</a>
                                            
                                            </td>
                                        @endif
                                        {{-- <td>{{ $serviceRequests->srResponseDateTime}}</td> --}}
                                        @if ($serviceRequests->srAssignedIntUserId === null)
                                            <td>Doctor</td>
                                        @endif
                                        <td>{{$serviceRequests->srStatus}}</td>
                                    </tr>
                                </tbody>

                            </table>

                            <h4 class="maroon mb-3"><b><u>PATIENT DETAILS</u></b></h4>
 
                            <table class="table table-bordered table-responsive mb-4">
                                <thead class="thead-dark">
                                    <th scope="col">Patient ID</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Patient Age</th>
                                    <th scope="col">Patient Background</th>
                                    <th scope="col">Patient Address</th>
                                    {{-- <th scope="col">Patient</th> --}}
                                </thead>

                                <tbody>
                                    <td>{{ $serviceRequests->patient->patId }}</td>
                                    <td>{{ $serviceRequests->patient->patFirstName }} {{ $serviceRequests->patient->patLastName }}</td>
                                    <td>{{ $serviceRequests->patient->patAge }}</td>
                                    <td>{{ $serviceRequests->patient->patBackground }}</td>
                                    <td> Patient Address</td>
                                </tbody>

                            </table>


                            <h4 class="maroon mb-3"><u><b>SERVICE DETAILS</b></u></h4>

                            @if ($serviceRequests->service_id === 1)
                                <table class="table table-bordered table-responsive mb-4">
                                    <thead class="thead-dark">
                                        <th scope="col">Patient Background</th>
                                        <th scope="col">Patient Question</th>
                                        <th scope="col">Doctor Response</th>
                                        <th scope="col">Prescription by doctor</th>
                                        {{-- <th scope="col">Patient</th> --}}
                                    </thead>
    
                                    <tbody>
                                        <td>{{ $serviceRequests->askQuestion->aaqPatientBackground }}</td>
                                        <td>{{ $serviceRequests->askQuestion->aaqQuestionText }}</td>
                                        @if ($serviceRequests->askQuestion->aaqDocResponse != null)
                                            <td>Responded at {{ $serviceRequests->srResponseDateTime}}</td>
                                        @else
                                            <td>Not Responded</td>
                                        @endif
                                        @if ($serviceRequests->askQuestion->aaqDocResponseUploaded != null)
                                            <td>{{ $serviceRequests->askQuestion->aaqDocResponseUploaded }}</td>                                            
                                        @endif
                                    </tbody>
    
                                </table>
                            @endif


                            @php
                                $patDocs = App\PatientDocument::where('documentUploadedBy', '=', Auth::user()->id)->get();
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
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
    
                                </table>
                            @endif   



                            <div class="btn-grouped float-right mt-4">
                                

                                {{-- Request Cancellation Button will only be available on below condiions. --}}
                                @if ($serviceRequests->srStatus != 'Cancelled' && $serviceRequests->askQuestion->aaqDocResponse === null)
                                   
                                    
                                    {{-- Upload Document Button --}}
                                @if ($serviceRequests->service_id === 1 || $serviceRequests->service_id === 2)
                                <a href="#" class="btn btn-maroon btn-md mb-2" data-toggle="modal" data-target="#uploadDocument">Upload Document</a>     
                                <div class="modal fade" id="uploadDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content " >
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Patient Document</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/upload-documents/{{$serviceRequests->id}}" method="POST" enctype="multipart/form-data">
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
                                                                <textarea name="documentDescription" id="documentDescription" cols="30" rows="4" placeholder="Document Description" class="form-control @error('documentDescription') is-invalid @enderror"  value="{{ old('documentDescription') }}" autocomplete="documentDescription" autofocus></textarea>
                                                                
                                
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



                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="documentDate">Date of Report/Prescription</label>
                                                                <input id="documentDate" type="date" placeholder="Document Filename" class="form-control @error('documentDate') is-invalid @enderror" name="documentDate" value="{{ old('documentDate') }}" required autocomplete="documentDate" autofocus>
                                
                                                                @error('documentDate')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="documentUploadedBy" id="documentUploadedBy" value="{{Auth::user()->id}}">
                                                        <input type="hidden" name="service_request_id" id="service_request_id" value="{{$serviceRequests->id}}">
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

                            @endif
                            
                            {{-- View Response Button --}}
                            @if ($serviceRequests->service_id === 1)
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-maroon btn-md mb-2">View Response</a>
                            
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">View Response</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($serviceRequests->askQuestion->aaqDocResponse === null)
                                                <h5 class="maroon">Doctor Not responded yet.</h5>

                                            @else
                                                <h5 class="maroon"> {{$serviceRequests->askQuestion->aaqDocResponse}}</h5>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-maroon btn-sm" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endif



                                
                                
                                    <form  action="/request-cancellation/{{$serviceRequests->id}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="srStatus" id="srStatus" value="Cancelled">
                                        <button type="submit" class="btn btn-maroon btn-md mb-2" onclick="return confirm('Are you sure you want to cancel?')">Request Cancellation</button>
                                    </form>
                                    
                                @endif




                                 
                            </div>
                            

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection