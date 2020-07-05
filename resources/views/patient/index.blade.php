@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div> --}}
        <div class="col-md">
            
            <div class="row">
                <div class="col-md-10">
                    
                        <div class="register-block">
                           <h2>User Patients</h2>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title"></h5>
                              <h6 class="card-subtitle mb-2 text-muted"></h6>
                              <p class="card-text">
                                @foreach($patients as $patient)
                                    {{ $patient }}
                                    <br>
                                    <br>
                                    <a href="{{ url('/user-patient/'.$patient->id.'/edit') }}" class="btn btn-primary btn-md">Edit details</a>
                                    @if($service == "AAQ")
                                    <a href="{{ url('/ask-a-doctor/'.$patient->id) }}" class="btn btn-primary btn-sm">Select Patient</a>
                                    {{-- @elseif($service == "") --}}
                                    @endif
                                @endforeach
                              </p>
                              
                              {{-- <a href="#" class="card-link">Another link</a> --}}
                            </div>
                        </div>
                        
                    
                </div>
            </div>     
        
        </div>
    </div>
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md">
                <br>
                <br>
                <h3 style="float:right">Add new patient </h3>
            </div>
            <div class="col-md">
                <br>
                <br>
                <a href="{{ url('/ask-a-doctor/0') }}" class="btn btn-primary btn-sm">Click here</a>
            </div>
        </div>
    </div>


</section>




@endsection