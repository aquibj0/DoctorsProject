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
                            <form action="{{ route('ask_a_doctor.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                        <h2 class="maroon MB-3"><b>PATIENT DETAILS</b></h2>
                                </div>
                                @if($patient != null)
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" name="patFirstName" value="{{ $patient->patFirstName }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="patLastName" value="{{ $patient->patLastName }}" disabled>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="gender" value="{{ $patient->patGender }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Age" name="age" value="{{ $patient->patAge }}" disabled>
                                    </div>
                                </div>
                                <input type="hidden" name="patient_id" value="{{$patient->id}}">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ $patient->patAddrLine1 }}" required disabled>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ $patient->patAddrLine2 }}" required disabled>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ $patient->patCity }}" required disabled>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="district" placeholder="District" name="district" value="{{ $patient->patDistrict }}" required disabled>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{ $patient->patState }}" required disabled>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="country" placeholder="Country" name="state" value="{{ $patient->patState }}" required disabled>
                                    </div>
                                </div>

                                @else <!-- without patient data -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" name="firstName" value="{{ old('firstName') }}" required>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" required>
                                    </div>
                                </div>

                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option selected disabled>Gender </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                        {{-- <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="gender" value="{{ $patient->patGender }}" disabled> --}}

                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Age" name="age" value="{{ old('age') }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                       <input type="number" class="form-control" id="mobileCC" placeholder="+91" name="mobileCC" value="{{ old('mobileCC') }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="number" class="form-control" id="mobileNo" placeholder="Mobile No." name="mobileNo" value="{{ old('mobileNo') }}" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ old('addressLine1') }}" required>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ old('addressLine2') }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ old('city') }}" required>
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="district" placeholder="District" name="district" value="{{ old('district') }}" required>
                                        </div>
                                </div>

                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{ old('state') }}" required>
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="{{ old('country') }}" required>
                                        </div>
                                </div>

                                @endif

                                

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="department" id="department" required>
                                            <option selected disabled>Department </option>
                                            <option value="Value 1">Value 1</option>
                                            <option value="value 2">Value 2</option>
                                            <option value="value 3">Value 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required></textarea>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <h2 class="maroon MB-3"><b>PATIENT QUESTION</b></h2>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="5" placeholder="Patient Question" required></textarea>
                                    </div>
                                </div>



                                {{-- <div class="form-row">
                                    <div class="mb-3">
                                        <h2 class="maroon MB-3"><b>UPLOAD PRESCRIPTION</b></h2>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="file" class="form-control" >
                                    </div>
                                </div> --}}


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