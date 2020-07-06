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
                            <div class="col-md-8 mt-4">
                                <div>
                                    <h5  class="maroon text-center"><b><u>PATIENT DETAILS</u></b></h5>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-responsive ">

                                                <tr>
                                                    <th scope="col">Patient ID</th>
                                                    <td>{{ $srvcReq->patient->patId }} </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Name</th>
                                                    <td>{{ $srvcReq->patient->patFirstName }} {{ $srvcReq->patient->patLastName }} </td>
                                                    
                                                </tr>

                                                <tr>
                                                    <th scope="row">Gender</th>
                                                    <td>{{ $srvcReq->patient->patGender }}</td>        
                                                </tr>
                                                <tr>    
                                                    <th scope="row">Age</th>
                                                    <td>{{ $srvcReq->patient->patAge}}</td>        
                                                </tr>
                                                {{-- <tr>    
                                                    <th scope="row">Patient background</th>
                                                    <td>{{ $srvcReq->patient->patBackground}}</td>        
                                                </tr> --}}
                                                <tr>    
                                                    <th scope="row">Patient background</th>
                                                    <td>{{ $srvcReq->askQuestion->aaqPatientBackground }}</td>        
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
                                                @endif

                                            </table>
                                            {{-- {{ $srvcReq->patient }} --}}
                                        </div>
                                            {{-- {{ $srvcReq->askQuestion }} --}}
                                    </div>
        
        
                                    {{-- <h5  class="maroon">Service Request Table</h5>
                                        <div class="card">{{ $srvcReq->askQuestion }}</div>
                                        
        
                                    <h5  class="maroon">Patient Table</h5>
                                    <div class="card">
                                        {{ $srvcReq->patient }}
                                    </div> --}}
                                    
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