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
                            {{ $aaq }}
                            <br>
                            <br>
                            {{ $srvcReq }}
                            <br>
                            <br>
                            {{ $patient }}
                            <br>
                            <br>
                            <form method="POST" action="{{ url('/doctor/ask-a-doctor/'.$aaq->id.'/response') }}" >
                                {{ csrf_field() }}

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="response" id="response" cols="30" rows="10" placeholder="Response"></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="mb-3">
                                        <h2 class="maroon MB-3"><b>UPLOAD PRESCRIPTION</b></h2>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="file" class="form-control" >
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