@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row">
        <div class="col-md-4" >
            <img src="{{asset('image/IMAGE7.jpg')}}" style="max-width:100%" alt="">
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
                                <form action="{{ route('ask_a_doctor.store') }}" method="POST">
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
                                        {{-- <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required></textarea>
                                            </div>
                                        </div> --}}


                                    @else <!-- without patient data -->

                                    <div class="form-row">
                                        {{-- Patient First Name Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" placeholder="First Name" name="firstName" value="{{ old('firstName') }}" required>
                                                @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        {{-- Patient Last Name Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" required>
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
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" required>
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

                                        {{-- Patient Age Input --}}
                                        <div class="form-group col-md-6">
                                            <select name="age" id="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
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
                                            <input type="text" placeholder="Mobile No" id="mobileNo" class="form-control @error('mobileNo') is-invalid @enderror" name="patMobileNo" value="{{ old('patMobileNo') }}" autocomplete="mobileNo" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            
                                            @error('mobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Patient Email Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control @error('patEmail') is-invalid @enderror" id="patEmail" placeholder="Email" name="patEmail" value="{{ old('patEmail') }}" required>
                                            
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
                                            <input type="text" class="form-control @error('addressLine1') is-invalid @enderror" id="addressLine1" placeholder="Address Line 1" name="addressLine1" value="{{ old('addressLine1') }}" required>
                                        
                                            @error('addressLine1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        {{-- Patient Address Line 2 input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('addressLine2') is-invalid @enderror" id="addressLine2" placeholder="Address Line 2" name="addressLine2" value="{{ old('addressLine2') }}" >
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
                                                <input type="text" class="form-control"class="form-control @error('city') is-invalid @enderror" id="city" placeholder="City" name="city" value="{{ old('city') }}" required>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    
                                            {{-- Patient District Input --}}
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control"class="form-control @error('district') is-invalid @enderror" id="district" placeholder="District" name="district" value="{{ old('district') }}" required>
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
                                                <input type="text" class="form-control"class="form-control @error('state') is-invalid @enderror" id="state" placeholder="State" name="state" value="{{ old('state') }}" required>
                                                @error('state')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                {{-- Patient Country Input --}}

                                                <select class="form-control @error('country') is-invalid @enderror" id="country" placeholder="Country" name="country" required value="{{ old('country') }}" >
                                                    <option value="India" selected>India</option>
                                                </select>
                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>

                                    @endif

                                    

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="department" id="department" required>
                                                {{-- <option selected disabled>Department </option> --}}
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
                                    </div>
                                    @if($patient)
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required maxlength="1024">{{ $patient->patBackground }}</textarea>
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
                                            <textarea class="form-control" name="patient_background" id="patient_background" cols="30" rows="5" placeholder="Patient Background" required maxlength="1024">{{ old('patient_background') }}</textarea>
                                            <small class="form-text text-muted">Maximun 1024 Characters.</small>
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
                                            <textarea class="form-control" name="patient_question" id="patient_question" cols="30" rows="5" placeholder="Patient Question" required>{{ old('patient_question') }}</textarea>
                                            <small class="form-text text-muted">Maximun 1024 Characters.</small>                                            
                                            @error('patient_question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
{{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "{{$response['currency']}}",
    "name": "{{$response['name']}}",
    "description": "{{$response['description']}}",
    "image": "https://example.com/your_logo", // You can give your logo url
    "order_id": "{{$response['orderId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        // After payment successfully made response will come here
        // Let's send this response to Controller for update the payment response
        // Create a form for send this data
        // Set the data in form
        document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
        document.getElementById('rzp_orderid').value = response.razorpay_order_id;
        document.getElementById('rzp_signature').value = response.razorpay_signature;

        // // Let's submit the form automatically
        document.getElementById('rzp-paymentresponse').click();
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "{{$response['contactNumber']}}"
    },
    "notes": {
        "address": "{{$response['address']}}"
    },
    "theme": {
        "color": "#F37254"
    }
};
var rzp1 = new Razorpay(options);
// window.onload = function(){
//     document.getElementById('rzp-button1').click();
// };
$( "#target" ).submit(function( event ) {
    rzp1.open();
    event.preventDefault();
}); --}}
@endsection