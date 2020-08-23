@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row">
        <div class="col-md-4 text-center" >
            <img class="mt-2 block-img" src="{{asset('image/IMAGE10.jpg')}}" alt="">
        </div>
        <div class="col-md-8" >
            
            <div class="row">
                <div class="col-md-8">
                    <div class="container">
                        <div class="ask-dcotor-form">
                            <div class="register-block">
                            <h2> Video Consultation</h2>
                            </div> 
                            @include('layouts.message')
                            <div>
                                <form action="{{ url('/video-consultation') }}" method="POST">
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
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="1" placeholder="Patient Background" required>{{ $patient->patBackground }}</textarea>
                                            @error('patient_background')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ $patient->patAddrLine1 }}" disabled>
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ $patient->patAddrLine2 }}" disabled>
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
                                            <input type="text" class="form-control" id="country" placeholder="Country" name="state" value="{{ $patient->patCountry }}" required disabled>
                                        </div>
                                    </div>

                                    @else <!-- without patient data -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('patFirstName') is-invalid @enderror" id="inputEmail4" placeholder="First Name" name="firstName" value="{{ old('firstName') }}" required>
                                            @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('patLastName') is-invalid @enderror" id="inputPassword4" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" required>
                                            @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
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
                                            {{-- <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="gender" value="{{ $patient->patGender }}" disabled> --}}
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{-- <input type="text" class="form-control" id="inputPassword4" placeholder="Age" name="age" value="{{ old('age') }}" required> --}}
                                            <select name="age" id="age" class="form-control @error('age') is-invalid @enderror">
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
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control @error('patient_background') is-invalid @enderror" name="patient_background" id="patient_background" cols="30" rows="1" placeholder="Patient Background" required>{{ old('patient_background') }}</textarea>
                                            @error('patient_background')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        {{-- <div class="form-group col-md"> --}}
                                        <input type="hidden" class="form-control " id="mobileCC" placeholder="+91" name="mobileCC" value="+91" required>
                                        {{-- </div> --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('patMobileNo') is-invalid @enderror" id="patMobileNo" placeholder="Mobile No." name="patMobileNo" value="{{ old('patMobileNo') }}" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            @error('patMobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control @error('patEmail') is-invalid @enderror" id="email" placeholder="Email" name="patEmail" value="{{ old('patEmail') }}" required>
                                            @error('patEmail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control  @error('addressLine1') is-invalid @enderror" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ old('addressLine1') }}" required>
                                            @error('addressLine1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('addressLine2') is-invalid @enderror" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ old('addressLine2') }}">
                                            @error('addressLine2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="City" name="city" value="{{ old('city') }}" required>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" placeholder="District" name="district" value="{{ old('district') }}">
                                                @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" placeholder="State" name="state" value="{{ old('state') }}" required>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                {{-- <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" placeholder="Country" name="country" value="{{ old('country') }}" required> --}}
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
                                            <input type="file" class="form-control @error('patPhotoFileNameLink') is-invalid @enderror" name="patPhotoFileNameLink"  id="patPhotoFileNameLink" value="{{ old('patPhotoFileNameLink') }}" >
                                            @error('patPhotoFileNameLink')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    @endif

                                    

                                    
                                    {{-- <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required></textarea>
                                        </div>
                                    </div> --}}


                                    <div class="mb-3">
                                        <h2 class="maroon MB-3"><b>APPOINTMENT</b></h2>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control @error('department') is-invalid @enderror" name="department" id="department" required>
                                                <option selected disabled>Department </option>
                                                @foreach($depts as $dept)
                                                    {{-- @if(old('department') == $dept->id)
                                                    <option value="{{ $dept->id }}" selected>{{ $dept->department_name }}</option>
                                                    @else --}}
                                                    <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="date" id="date" name="date" class="some form-control  @error('date') is-invalid @enderror" id="my_date_picker" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" max="{{ Carbon\Carbon::today()->add(15, 'days')->toDateString() }}">         
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control some @error('appointmentType') is-invalid @enderror" name="appointmentType" id="appointmentType" required>
                                                {{-- @if(old('appointmentType') == "VTD")
                                                <option disabled>Team  or Expert</option>
                                                <option value="VTD" selected>Birth Team Doctor</option>
                                                <option value="VED">Dr. Khastgir</option>
                                                @elseif(old('appointmentType') == "VED")
                                                <option selected disabled>Team  or Expert</option>
                                                <option value="VTD">Birth Team Doctor</option>
                                                <option value="VED" selected>Dr. Khastgir</option>
                                                @else --}}
                                                <option selected disabled>Team  or Expert</option>
                                                <option value="VTD">Birth Team Doctor</option>
                                                <option value="VED">Dr. Khastgir</option>
                                                {{-- @endif --}}
                                            </select>
                                            @error('appointmentType')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <select class="form-control @error('slot') is-invalid @enderror" name="slot" id="slot" required>
                                                <option disabled selected>Select Time</option>
                                                {{-- <option value="#">Something</option> --}}
                                            </select>
                                            @error('slot')
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


</section >
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //date change

        $('.some').on('change', function(){
            var appType = $("#appointmentType").val();
            var date = $("#date").val();
            // console.log(appType);
            // console.log(date);
            $('#slot').find('option').not(':first').remove();
            if(date){
                $.ajax({
                    url: '/getSlots/'+date+'/'+appType,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        // console.log(data);
                        if(data){
                            $.each(data, function(key, value){
                                $("#slot").append("<option value='"+value+"'>"+key+"</option>");
                            });
                        }
                    },
                    error: function(){
                        // console.log('error');
                    }
                });
            }
        });
    });
</script>

@endsection