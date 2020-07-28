@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row">
        <div class="col-md-4" >
            <img src="{{asset('image/IMAGE5.jpg')}}" style="max-width:100%" alt="">

        </div>
        <div class="col-md-8">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="container">
                        <div class="ask-dcotor-form">
                            <div class="register-block">
                            <h2>Clinic Appointment</h2>
                            </div> 
                            <div>
                                
                                <form action="{{ url('/clinic-appointment') }}" method="POST">
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
                                            @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" required>
                                            @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{-- <input type="text" class="form-control" id="inputPassword4" placeholder="Age" name="age" value="{{ old('age') }}" required> --}}
                                            <select name="age" id="age" class="form-control">
                                                <option disabled selected>Select age</option>
                                                @for($i=10; $i<90 ;$i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
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
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="1" placeholder="Patient Background" required>{{ old('patient_background') }}</textarea>
                                            @error('patient_background')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        {{-- <div class="form-group col-md"> --}}
                                        <input type="hidden" class="form-control" id="mobileCC" placeholder="+91" name="mobileCC" value="+91" required>
                                        {{-- </div> --}}
                                        <div class="form-group col-md-6">
                                            <input type="number" onkeypress='validate(event)' class="form-control" id="patMobileNo" placeholder="Mobile No." name="patMobileNo" value="{{ old('patMobileNo') }}" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            @error('patMobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="patEmail" value="{{ old('patEmail') }}" required>
                                            @error('patEmail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ old('addressLine1') }}" required>
                                            @error('addressLine1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ old('addressLine2') }}">
                                            @error('addressLine2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ old('city') }}" required>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="district" placeholder="District" name="district" value="{{ old('district') }}" required>
                                                @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{ old('state') }}" required>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="{{ old('country') }}" required>
                                                @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="number" onkeypress='validate(event)' class="form-control" id="patMobileNo" placeholder="Mobile No." name="patMobileNo" value="{{ old('patMobileNo') }}" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            @error('patMobileNo')
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
                                        <h2 class="maroon MB-3"><b>Appointment</b></h2>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="department" id="department" required>
                                                <option selected disabled>Department </option>
                                                @foreach($depts as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    {{-- </div>
                                    <div class="form-row"> --}}
                                        <div class="form-group col-md-6">
                                            <input type="date" name="date" id="date" placeholder="Pick a date" class="some form-control" id="my_date_picker" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" max="{{ Carbon\Carbon::today()->add(15, 'days')->toDateString() }}">         
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="some form-control" name="appointmentLoc" id="appointmentLoc" required>
                                                <option selected disabled>Select Location</option>
                                                @foreach ($location as $item)
                                                    <option value="{{ $item->id }}">{{ $item->clinicName }}</option>
                                                @endforeach
                                            </select>
                                            @error('apointmentLoc')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="some form-control" name="service" id="service" required>
                                                <option disabled selected>Select Type</option>
                                                <option value="CED">Dr. Khastgir</option>
                                                <option value="CTD">Birth Team Doctor</option>
                                            </select>
                                            @error('service')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="slot" id="slot" required>
                                                <option disabled selected>Select Time</option>
                                            </select>
                                            @error('slot')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-maroon btn-md mt-2" style="width:100%">SUBMIT</button>
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        
        </div>
    </div>


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //date change

        $('.some').on('change', function(){
            // var appType = $(this).val();
            var date = $("#date").val();
            var loc = $("#appointmentLoc").val();
            var service = $(this).val();
            console.log(loc);
            console.log(date);
            console.log(service);

            $('#slot').find('option').not(':first').remove();
            if(service){
                $.ajax({
                    url: '/getLocSlots/'+date+'/'+service+'/'+loc,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        if(data){
                            $.each(data, function(key, value){
                                $("#slot").append("<option value='"+value+"'>"+key+"</option>");
                            });
                        }
                    },
                    error: function(){
                        console.log('error');
                    }
                });
            }
        });
    });
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>



@endsection