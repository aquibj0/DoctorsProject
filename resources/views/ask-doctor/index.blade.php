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
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" name="firstName" value="{{ old('firstName') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}">
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
                                        <input type="number" class="form-control" id="inputPassword4" placeholder="Age" name="age" value="{{ old('age') }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="department" id="department">
                                            <option selected disabled>Department </option>
                                            <option value="Value 1">Value 1</option>
                                            <option value="value 2">Value 2</option>
                                            <option value="value 3">Value 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background"></textarea>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <h2 class="maroon MB-3"><b>PATIENT QUESTION</b></h2>
                                </div>

{{--                                 
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="Mobile No.">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="Email Id">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputAddress" placeholder="Address Line 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Address Line 2">
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="City">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="District">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="Pincode">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="inputPassword4" placeholder="State">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputAddress" placeholder="Country">
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="inputCity">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                    <input type="text" class="form-control" id="inputZip">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                    </div>
                                </div> --}}

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="5" placeholder="Patient Question"></textarea>
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