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
                            {{-- @foreach($asadoc as $item)
                                <div class="row">
                                    <div class="col-md">{{  }}</div>
                                    <div class="col-md"></div>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>     
        
        </div>
    </div>


</section>




@endsection