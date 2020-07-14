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
                           <h2>ADD NEW PATIENT</h2>
                        </div>
                        <div>
                            <form action="{{ route('ask_a_doctor.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName" value="{{ old('firstName') }}">
                                        @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}">
                                    
                                        @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" autocomplete="gender">
                                            <option selected disabled>Gender </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>

                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-md-6">
                                        
                                        <select id="age" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" autocomplete="age">
                                            <option selected disabled>Select Age </option>
                                            
                                            @for ($i = 10; $i < 100; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                        </select>
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        {{-- <input type="number" class="form-control" id="age" placeholder="Age" name="age" value="{{ old('age') }}"> --}}
                                   
                                    </div>
                                    {{-- <div class="form-group col-md-1">
                                        
                                        <select id="mobileCC" class="form-control @error('mobileCC') is-invalid @enderror" name="mobileCC" value="{{ old('mobileCC') }}" autocomplete="mobileCC">
                                            <option selected value="+91">+91</option>
                                        </select>
                                        
                                        @error('mobileCC')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}


                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="{{ old('mobileNumber') }}" placeholder="10 digit mobile number">
                                         @error('mobileNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="background" id="background" cols="30" rows="5" placeholder="Patient Background"></textarea>
                                    
                                        @error('background')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="5" placeholder="Patient Question"></textarea>
                                    
                                        @error('patient_question')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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


{{-- hey how's you? --}}

@endsection