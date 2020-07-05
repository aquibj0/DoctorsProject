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
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="gender" id="gender">
                                            <option selected disabled>Gender </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="number" class="form-control" id="age" placeholder="Age" name="age" value="{{ old('age') }}">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <input type="text" class="form-control" id="mobileCC" name="mobileCC" value="{{ old('mobileCC') }}" placeholder="+91">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="{{ old('mobileNumber') }}" placeholder="10 digit mobile number">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="background" id="background" cols="30" rows="5" placeholder="Patient Background"></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="5" placeholder="Patient Question"></textarea>
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