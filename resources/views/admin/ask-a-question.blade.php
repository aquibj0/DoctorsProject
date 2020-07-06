@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        <div class="col-md-4" style="background:#142cd6; height:100vh;"></div>
        <div class="col-md-8" style=" height:100vh;">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ask-dcotor-form">
                        <div class="register-block">
                           <h2> Ask a doctor</h2>
                        </div>
                        <div>
                            <h5>Ask a Question Table</h5>
                                <div class="card">{{ $aaq }}</div>


                            <h5>Service Request Table</h5>
                                <div class="card">{{ $srvcReq }}</div>


                            <h5>Patient Table</h5>
                            <div class="card">{{ $patient }}</div>
                            <br>

                            <form method="POST" action="{{ url('/admin/ask-a-doctor/'.$aaq->id.'/response') }}" >
                                {{ csrf_field() }}

                                <div class="form-row">
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
                </div>
            </div>     
        
        </div>
    </div>


</section>




@endsection