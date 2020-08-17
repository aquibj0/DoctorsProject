@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row">
        <div class="col-md-4 text-center" >
            <img  src="{{asset('image/IMAGE7.jpg')}}" class="block-img mt-4" alt="">
        </div>
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="ask-dcotor-form">
                            <div class="register-block">
                                <h2> Ask a doctor</h2>
                            </div>   
                            <div>
                                @include('layouts.message')
                                <form action="{{ route('ask_a_doctor.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="mb-2">
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
                                                <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ $patient->patMobileNo }}" required disabled>
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ $patient->patEmail }}" required disabled>
                                            </div>
                                        </div>
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
                                                <input type="text" class="form-control" id="district" placeholder="District" name="district" value="{{ $patient->patDistrict }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{ $patient->patState }}" required disabled>
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="country" placeholder="Country" name="state" value="{{ $patient->patCountry }}" required disabled>
                                            </div>
                                        </div>
                                        {{-- <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required></textarea>
                                            </div>
                                        </div> --}}


                                    @else <!-- without patient data -->

                                    <div class="form-row">
                                        {{-- Patient First Name Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" placeholder="First Name" name="firstName" value="{{ old('firstName') }}" max="35" required>
                                                @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        {{-- Patient Last Name Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" max="35" required>
                                                @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="form-row">
                                        {{-- Patient Gender Input --}}
                                        <div class="form-group col-md-6">
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                                @if(old('gender') == "Male")
                                                <option disabled>Gender </option>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Trans">Transgender</option>
                                                @elseif(old('gender') == "Female")
                                                <option disabled>Gender </option>
                                                <option value="Male" >Male</option>
                                                <option value="Female" selected>Female</option>
                                                <option value="Trans">Transgender</option>
                                                @elseif(old('gender') == "Trans")
                                                <option disabled>Gender </option>
                                                <option value="Male" >Male</option>
                                                <option value="Female" >Female</option>
                                                <option value="Trans" selected>Transgender</option>
                                                @else
                                                <option selected disabled>Gender </option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Trans">Transgender</option>
                                                @endif
                                            </select>

                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Patient Age Input --}}
                                        <div class="form-group col-md-6">
                                            <select name="age" id="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                                                <option disabled selected>Select age</option>
                                                @for($i=10; $i<90 ;$i++)
                                                    @if(old('age') == $i)
                                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>

                                            @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        {{-- Patient Mobile Code Input --}}
                                        <div class="form-group col-md-2">
                                            <select class="form-control @error('mobileCC') is-invalid @enderror" name="mobileCC" value="{{ old('mobileCC') }}" autocomplete="mobileCC" id="mobileCC" required>
                                                <option selected value="+91">+91</option>
                                            </select>

                                            @error('mobileCC')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Patient Phone No Input --}}
                                        <div class="form-group col-md-4">
                                            <input type="text" placeholder="Mobile No" id="patMobileNo" class="form-control @error('patMobileNo') is-invalid @enderror" name="patMobileNo" value="{{ old('patMobileNo') }}" autocomplete="patMobileNo" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            
                                            @error('patMobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Patient Email Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control @error('patEmail') is-invalid @enderror" id="patEmail" placeholder="Email" name="patEmail" value="{{ old('patEmail') }}" max="191" required>
                                            
                                            @error('patEmail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        {{-- Patient Address Line 1 Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('addressLine1') is-invalid @enderror" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ old('addressLine1') }}" max="35" required>
                                        
                                            @error('addressLine1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        {{-- Patient Address Line 2 input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('addressLine2') is-invalid @enderror" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ old('addressLine2') }}" max="35" >
                                            @error('addressLine2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        {{-- Patient City Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control"class="form-control @error('city') is-invalid @enderror" id="city" placeholder="City" name="city" value="{{ old('city') }}" max="35" required>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        {{-- Patient District Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control"class="form-control @error('district') is-invalid @enderror" id="district" placeholder="District" name="district" value="{{ old('district') }}" max="35">
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            {{-- patient state Input --}}
                                            <input type="text" class="form-control"class="form-control @error('state') is-invalid @enderror" id="state" placeholder="State" name="state" value="{{ old('state') }}" max="35" required>
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            {{-- Patient Country Input --}}

                                            <select class="form-control @error('country') is-invalid @enderror" id="country" placeholder="Country" name="country" required value="{{ old('country') }}">
                                                <option value="India" selected>India</option>
                                            </select>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row ">
                                        <div class="form-group col-md-12">
                                            <div class="mb-3">
                                                <h2 class="maroon MB-3"><b>PATIENT PICTURE</b></h2>
                                            </div>
                                           <input name="patPhotoFileNameLink" type="file" class="form-control @error('patPhotoFileNameLink') is-invalid @enderror" id="patPhotoFileNameLink"   value="{{ old('patPhotoFileNameLink') }}" >
                                            @error('patPhotoFileNameLink')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @endif

                                    

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <select class="form-control" name="department" id="department" required>
                                                <option selected disabled>Department </option>
                                                @foreach($depts as $dept)
                                                    @if(old('department') == $dept->id)
                                                    <option value="{{ $dept->id }}" selected>{{ $dept->department_name }}</option>
                                                    @else
                                                    <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($patient)
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="1" placeholder="Patient Background" required maxlength="1024">{{ $patient->patBackground }}</textarea>
                                            @error('patient_background')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="1" placeholder="Patient Background" required maxlength="1024">{{ old('patient_background') }}</textarea>
                                            
                                            @error('patient_background')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @endif


                                    <div class="mb-3">
                                        <h2 class="maroon MB-3"><b>PATIENT QUESTION</b></h2>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="1" placeholder="Patient Question" required>{{ old('patient_question') }}</textarea>                                          
                                            @error('patient_question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                        <button type="submit" class="btn btn-maroon btn-md mt-2 mb-3" style="width:100%">SUBMIT</button>
                                
                                    <div class="form-row">
                                        <div class="col-md">
                                            *Payment and Cancellation <br>
                                            1. Payment should be made in advance to make a booking. <br>
                                            2. For refund please refer to our Policy as well as Terms & Conditions. <br>
                                            3. Appointments could be cancelled only with 48 hours notice. <br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</section>
@endsection