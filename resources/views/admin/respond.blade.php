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
    
                        <h5 class="maroon"><b>PATIENT DETAILS </b></h5>
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
                                    <th>Patient Age</th>
                                    <td>{{$srvcReq->patient->patAge}}</td>        
                                </tr>
                                    
                                <tr>
                                    <th>Patient Age</th>
                                    <td>{{$srvcReq->patient->patAge}}</td>        
                                </tr>
                                 <tr>
                                    <th>Patient Background</th>
                                    <td>{{$srvcReq->patient->patBackground}}</td>        
                                </tr>
                            </tbody>
                          
                        </table>
                        <h5 class="maroon"><b><u>Question</u> </b></h5>
                        <div style="border:1px solid rgb(97, 13, 13);"> 
                            {{$srvcReq->askQuestion->aaqQuestionText}}
                        </div>
                    </div>
                    <div class="col-md-6" style="border:1px solid #000; padding: 15px">
    
                        @if ($srvcReq->askQuestion->aaqDocResponse != null)
                            <p>{{$srvcReq->askQuestion->aaqDocResponse}}</p> 
    
                        @else
                            <form  method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
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
                    
                                <button type="submit" class="btn btn-maroon btn-lg" style="width:100%">SUBMIT</button>
                            </form>
                        @endif
    
    
                     
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
                                    <th>Patient Age</th>
                                    <td>{{$srvcReq->patient->patAge}}</td>        
                                </tr>
                                <tr>
                                    <th>Patient Gender</th>
                                    <td>{{$srvcReq->patient->patGender}}</td>        
                                </tr>
                                    
                                 <tr>
                                    <th>Patient Background</th>
                                    <td>{{$srvcReq->patient->patBackground}}</td>        
                                </tr>
                            </tbody>
                          
                        </table>
                    </div>
                    <div class="col-md-6" style="border:1px solid #000; padding: 15px">
                        <h5 class="maroon"><b><u>DOCTOR COMMENTS INTERNAL</u> </b></h5>
                        <form action="#" method="POST">
                            <textarea  class="form-control" name="" id="" cols="30" rows="10"></textarea>
                            <div class="form-group text-center mb-0">
                                <input type="submit" class=" mt-2 btn btn-maroon">
                            </div>
                        </form>
    
                     
                    </div>
                </div>
            </div>
        </div>
    </div>   

@endif


@endsection