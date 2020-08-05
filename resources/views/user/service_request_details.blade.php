@extends('layouts.app')


@section('content')
    <section class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="register-block">
                        <h2>Service Requests Details</h2>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row service-request-details">
                        <div class="col-md-12">
                            @include('layouts.message')

                            {{-- Service Request Details Table --}}

                            <div class="mt-2 mb-2">
                                <p class="maroon location-hidden"><b> “Pan right or rotate screen to view all details”
                                </b></p>
                            </div>
                            <h4 class="maroon mb-2"><b><u>SERVICE REQUEST DETAILS</u></b></h4>

                            <table class="table table-bordered table-responsive mb-3">
                                <thead class="thead-dark">
                                    <th scope="col">Service Req Id</th>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Sr Department</th>
                                    <th scope="col">Expected Response</th>
                                    <th scope="col">Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $serviceRequests->srId }}</td>
                                        <td>{{ $serviceRequests->service->srvcName }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($serviceRequests->srRecievedDateTime)) }}
                                        </td>
                                        <td>
                                            @php
                                                $dept = App\Department::select('department_name')->where('id', '=', $serviceRequests->srDepartment)->first() 
                                            @endphp
                                            {{ $dept->department_name }}
                                        
                                        </td>

                                        <td>{{ date('d-m-Y', strtotime($serviceRequests->srDueDateTime)) }}</td>
                                        
                                        <td>{{$serviceRequests->srStatus}}</td>
                                    </tr>
                                </tbody>

                            </table>



                            {{-- Payment Details --}}


                            {{-- @if ($serviceRequests->)
                                
                            @endif --}}


                            {{-- Patient Details Table --}}
                            <h4 class="maroon mb-2"><b><u>PATIENT DETAILS</u></b></h4>
 
                            <table class="table table-bordered table-responsive mb-3">
                                <thead class="thead-dark">
                                    <th scope="col">Name</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Location</th>
                                </thead>

                                <tbody>
                                    <td>{{ $serviceRequests->patient->patFirstName }} {{ $serviceRequests->patient->patLastName }}</td>
                                    <td>{{ $serviceRequests->patient->patAge }}</td>
                                    <td>{{ $serviceRequests->patient->patGender }}</td>
                                    <td>{{ $serviceRequests->patient->patAddrLine1 }}, {{ $serviceRequests->patient->patCity }}, {{ $serviceRequests->patient->patDistrict }}, {{ $serviceRequests->patient->patState }} </td>
                                </tbody>

                            </table>


                            {{-- Service Details --}}
                            

                            {{-- Showing service details of ASK A QUESTION --}}
                            @if (isset($serviceRequests->askQuestion))
                                @if($serviceRequests->paymentStatus == true)
                                @php
                                    $paymentDetails = App\Payment::where('service_req_id', '=', $serviceRequests->id)->first();
                                @endphp
                                <h4 class="maroon mb-2"><u><b>PAYMENT DETAILS</b></u></h4>

                                <table class="table table-bordered table-responsive mb-4">
                                    <thead class="thead-dark">
                                        <th scope="row">Payment Status</th>
                                        <th scope="row">Payment ID</th>
                                        <th scope="row">Payment Time</th>
                                        <th scope="row">Payment Amount</th>
                                    </thead>
                                    <tbody>
                                        <td>Paid</td>
                                        <td>{{$paymentDetails->payment_transaction_id}}</td> 
                                        <td>{{ date('d-m-Y ', strtotime($paymentDetails->created_at))}}</td>
                                        <td>{{$paymentDetails->payment_amount }}</td>
                                    </tbody>
                                    
    
                                </table>
                                @endif
                                {{-- Patient Uploaded Documents --}}
                                @php
                                $patDocs = App\PatientDocument::where([
                                    ['documentUploadedBy', '=', Auth::user()->id],
                                    ['service_request_id', '=', $serviceRequests->id]
                                ])->orderBy('documentUploadDate', 'ASC')->get();
                                @endphp

                                @if (isset($patDocs))
                                    <h4 class="maroon mb-2"><u><b>PATIENT DOCUMENTS</b></u></h4>
                                    <small class="maroon">Uploaded by patient</small>
                                    <table class="table table-bordered table-responsive mb-3">
                                        <thead class="thead-dark">
                                            {{-- <th scope="col">Sr. No</th> --}}
                                            <th scope="col">Docuement Type</th>
                                            <th scope="col">Docuement Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Docuement Date</th>
                                            <th scope="col">Uploaded Date</th>
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
                                                    <td>{{ date('d-m-Y ', strtotime($patDoc->documentDate))  }}</td>
                                                    <td>{{ date('d-m-Y ', strtotime($patDoc->documentUploadDate))  }}</td>
                                                    <td>
                                                        <form action="/upload-documents/delete/{{$patDoc->id}}" method="post">

                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            @if($serviceRequests->srStatus != "CLOSED")
                                                            <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure?')">Delete </button>
                                                            @else
                                                            <button type="submit" class="btn btn-maroon btn-sm" onclick="return false;" disabled>Delete </button>
                                                            @endif
                                                        </form>                                                  
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>

                                    </table>
                                    <small class="maroon">* To upload more document click Add Document</small>
                                @endif   

                                @if ($serviceRequests->paymentStatus == true)
                                <div class="btn-grouped float-right mt-4">
                                

                                        {{-- Request Cancellation Button will only be available on below condiions. --}}
                                        @if ($serviceRequests->srStatus != 'Cancelled')
                                            
                                            
                                            {{-- Upload Document Button --}}
                                            @if ($serviceRequests->service_id === 1 || $serviceRequests->service_id === 2)
                                                <a href="#" class="btn btn-maroon btn-md mb-2" data-toggle="modal" data-target="#uploadDocument">Add Document</a>     
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
                                                                            <div class="col-md" class="color: grey">
                                                                                *Instructions for Uploading Reports<br>
                                                                                1. Upload latest prescription and investigation reports.<br>
                                                                                2. Reports should not be more than 3 months old.<br>
                                                                                3. For 'Ask A Doctor' reports can be uploaded at least<br>
                                                                                4. For video consultation booking reports should be loaded at 
                                                                                least 24 hours prior to appointment.
                                                                            </div>
                                                                        </div>

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
        
        
        
                                                                        <div class="form-group row">
                                                                            <div class="col-md-12">
                                                                                <label for="documentDate">Date of Report/Prescription</label>
                                                                                <input id="documentDate" type="date" placeholder="Document Filename" class="form-control @error('documentDate') is-invalid @enderror" name="documentDate" value="{{ old('documentDate') }}" required min="{{Carbon\Carbon::today()->subMonths(6)->toDateString()}}" max="{{Carbon\Carbon::today()->addDays(1)->toDateString()}}" autocomplete="documentDate" autofocus>
                                                                                 
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
                                                            <tbody>
                                                                <h5><b>Patient Background</b>: {{ $serviceRequests->askQuestion->aaqPatientBackground }}</h5>
                                                                <h5><b>Patient Question</b>: {{ $serviceRequests->askQuestion->aaqQuestionText }}</h5>
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
        
                                            <a href="#" data-toggle="modal" data-target="#requestCancellation" class="btn btn-maroon btn-md mb-2">Request Cancellation</a>                                
                                        
                                            <div class="modal fade" id="requestCancellation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><b>Request Cancellation</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form  action="/request-cancellation/{{$serviceRequests->id}}" method="POST">
        
                                                        <div class="modal-body">
        
                                                            Cancell Request No {{$serviceRequests->srId}} ?
                                                            @csrf
                                                            <input type="hidden" name="srStatus" id="srStatus" value="Cancelled">
        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure you want to cancel?')">Request Cancellation</button>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            </form>
                                        @endif                                 
                                    </div>
                                @else
                                <div class="btn-grouped float-right mt-4">
                                    <a href="#" class="btn btn-maroon btn-md">Pay now</a>
                                </div>
                                @endif


                            {{-- Showing service details of VIDEOCALL --}}
                            @elseif(isset($serviceRequests->videoCall))

                                <h4 class="maroon mb-2"><u><b>APPOINTMENT DETAILS</b></u></h4>
                                <table class="table table-bordered table-responsive mb-4">
                                    <thead class="thead-dark">
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Prescription by doctor</th>
                                        {{-- <th scope="col">Patient</th> --}}
                                    </thead>
                                    <tbody>

                                        <td>
                                            @if ($serviceRequests->appointmentSchedule->appmntType === 'VED')
                                                Video Call With Expert Doctor
                                            @endif
                                        </td>
                                        <td>{{$serviceRequests->appointmentSchedule->appmntDate}}</td>
                                        <td>{{$serviceRequests->appointmentSchedule->appmntSlot}}</td>
                                        <td></td>

                                    </tbody>
                                </table>
                            

                                {{-- Patient Uploaded Documents --}}
                                @php
                                $patDocs = App\PatientDocument::where([
                                    ['documentUploadedBy', '=', Auth::user()->id],
                                    ['service_request_id', '=', $serviceRequests->id]
                                ])->orderBy('documentUploadDate', 'ASC')->get();
                                @endphp

                                @if (isset($patDocs))
                                    <h4 class="maroon mb-2"><u><b>PATIENT DOCUMENTS</b></u></h4>
                                    <table class="table table-bordered table-responsive mb-3">
                                        <thead class="thead-dark">
                                            {{-- <th scope="col">Sr. No</th> --}}
                                            <th scope="col">Docuement Type</th>
                                            <th scope="col">Docuement Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Docuement Date</th>
                                            <th scope="col">Uploaded Date</th>
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
                                                    <td>
                                                     
                                                     <form action="/upload-documents/delete/{{$patDoc->id}}" method="post">


                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure?')">Delete </button>
                                                     </form>
                                                                                                       
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>

                                    </table>
                                    <small class="maroon">* To upload more document click Add Document</small>
                                @endif   

                                
                                {{-- Doctor Uploaded Prescription --}}
                                @php
                                $patPrescriptions = App\PatientDocument::where([
                                    ['service_request_id', '=', $serviceRequests->id],
                                    ['documentUploadedBy', '!=', Auth::user()->id],
                                ])->orderBy('documentUploadDate', 'ASC')->get();
                                @endphp

                                @if (isset($patPrescriptions))

                                    <h4 class="maroon mb-2"><u><b>DOCTOR'S PRESCRIPTIONS</b></u></h4>    
                                    <table class="table table-bordered table-responsive mb-3">
                                        <thead class="thead-dark">
                                            <th scope="col">Docuement Type</th>
                                            <th scope="col">Docuement Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Docuement Date</th>
                                            <th scope="col">Uploaded Date</th>
                                            <th scope="col">Action</th>
                                        </thead>

                                        <tbody>
                                            @foreach ($patPrescriptions as $patPrescription)
                                                <tr>
                                                    <td>{{ $patPrescription->documentType }}</td>
                                                    <td>{{ $patPrescription->documentFileName }} </td>
                                                    <td>{{ $patPrescription->documentDescription }}</td>
                                                    <td>{{ $patPrescription->documentDate }}</td>
                                                    <td>{{ $patPrescription->documentUploadDate }}</td>
                                                    <td>
                                                        <a href="/downloadDoc/{{$patPrescription->id}}" class="btn-maroon btn-sm btn">Download</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>

                                    </table>
                                @endif



                                <div class="btn-grouped float-right mt-4">
                                

                                    {{-- Request Cancellation Button will only be available on below condiions. --}}
                                    @if ($serviceRequests->srStatus != 'Cancelled')
                                        
                                        
                                        {{-- Upload Document Button --}}
                                        @if ($serviceRequests->service_id != 4 || $serviceRequests->service_id != 5)
                                            <a href="#" class="btn btn-maroon btn-md mb-2" data-toggle="modal" data-target="#uploadDocument">Add Document</a>     
                                            {{-- Upload Prescription Modal --}}
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
                                                                        <div class="col-md" class="color: grey">
                                                                            *Instructions for Uploading Reports<br>
                                                                            1. Upload latest prescription and investigation reports.<br>
                                                                            2. Reports should not be more than 3 months old.<br>
                                                                            3. For 'Ask A Doctor' reports can be uploaded at least<br>
                                                                            4. For video consultation booking reports should be loaded at 
                                                                            least 24 hours prior to appointment.
                                                                        </div>
                                                                    </div>

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
    
    
    
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <label for="documentDate">Date of Report/Prescription</label>
                                                                            <input id="documentDate" type="date" min="{{Carbon\Carbon::today()->subMonths(3)->toDateString()}}" max="{{ Carbon\Carbon::today()->addDays(1)->toDateString() }}" placeholder="Document Filename" class="form-control @error('documentDate') is-invalid @enderror" name="documentDate" value="{{ old('documentDate') }}" required autocomplete="documentDate" autofocus>
                                            
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
                                        
                                            {{-- View Response Modal --}}
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
    
    
                                        {{-- Request Cancellation --}}
                                        <a href="#" data-toggle="modal" data-target="#requestCancellation" class="btn btn-maroon btn-md mb-2">Request Cancellation</a>                                
                                    
                                        {{-- Request Cancellation Modal --}}
                                        <div class="modal fade" id="requestCancellation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Request Cancellation</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form  action="/request-cancellation/{{$serviceRequests->id}}" method="POST">
    
                                                    <div class="modal-body">
    
                                                        Cancell Request No {{$serviceRequests->srId}} ?
                                                        @csrf
                                                        <input type="hidden" name="srStatus" id="srStatus" value="Cancelled">
    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure you want to cancel?')">Request Cancellation</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        </form>
                                    @endif                                 
                                </div>


                            @elseif(isset($serviceRequests->clinicAppointment))
                                <h4 class="maroon mb-2"><u><b>APPOINTMENT DETAILS</b></u></h4>
                                <table class="table table-bordered table-responsive mb-4">
                                    <thead class="thead-dark">
                                        <th scope="col">Clinic Type </th>
                                        <th scope="col">Clinic Name</th>
                                        <th scope="col">Contact No</th>
                                        <th scope="col">Location</th>
                                        {{-- <th scope="col">Patient</th> --}}
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{$serviceRequests->clinicAppointment->clinic->clinicType}}
                                            </td>
                                            <td>{{$serviceRequests->clinicAppointment->clinic->clinicName}}</td>
                                            <td>
                                                Mobile No. : {{$serviceRequests->clinicAppointment->clinic->clinicMobileNo}}<br>
                                                Landline No. : {{$serviceRequests->clinicAppointment->clinic->clinicLandLineNo}} 
                                            </td>
                                            <td>
                                                {{$serviceRequests->clinicAppointment->clinic->clinicAddressLine1}}, {{$serviceRequests->clinicAppointment->clinic->clinicAddressLine2}}, {{$serviceRequests->clinicAppointment->clinic->clinicCity}}, {{$serviceRequests->clinicAppointment->clinic->clinicDistrict}}, {{$serviceRequests->clinicAppointment->clinic->clinicState}},
                                                {{$serviceRequests->clinicAppointment->clinic->clinicCountry}}, {{$serviceRequests->clinicAppointment->clinic->clinicPincode}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection