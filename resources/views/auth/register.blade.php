@extends('layouts.app')

@section('content')

<div class="row" >
    <div class="col-md-4" style="background:#142cd6; min-height:100vh;"></div>
    <div class="col-md-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="user-register-form">
                    <div class="register-block mt-4">
                        <h2 class="mb-0"> <b>REGISTER</b></h2>
                    </div>
                    @include('layouts.message')

                    <div class="mt-3">
                        <form method="POST" action="{{ route('register_user') }}">
                            @csrf
    
                            <div class="form-row">

                                <div class="col-md-6 form-group">
                                    <input id="firstName" type="text" placeholder="First Name" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                    @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input id="lastName" type="text" placeholder="Last Name" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <input id="userMobileNo" type="number" placeholder="Mobile No." class="form-control @error('userMobileNo') is-invalid @enderror" name="userMobileNo" value="{{ old('mobile') }}" required autocomplete="userMobileNo" autofocus oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">

                                    @error('userMobileNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group"> 
                                        <input id="landlineNo" type="text" placeholder="Landline No." class="form-control @error('landlineNo') is-invalid @enderror" name="landlineNo" value="{{ old('landlineNo') }}" autocomplete="landlineNo" autofocus>
    
                                        @error('landlineNo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row" >
                                <div class="col-md-12">
                                        <input id="userEmail" type="email" placeholder="Email" class="form-control @error('userEmail') is-invalid @enderror" name="userEmail" value="{{ old('userEmail') }}" autocomplete="userEmail">
                                        
                                        @error('userEmail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1">
                                    <input type="checkbox" class="form-control" onclick="myFunction()">
                                    <script>
                                        function myFunction() {
                                            var x = document.getElementById("password");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        } 
                                    </script>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="col-md-1">
                                    <input type="checkbox" class="form-control" onclick="myFunctionConfirm()">
                                    <script>
                                        function myFunctionConfirm() {
                                            var x = document.getElementById("password-confirm");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        } 
                                    </script>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12 mb-2">
                                    <input type="checkbox" id="terms" onchange="confirm()">
                                    <label for="">I Agree with all the statements in <a href="{{ url('/terms-and-condition') }}"><u>Terms of Services</u></a></label>
                                    <script>
                                        function confirm(){
                                            var checkbox = document.getElementById('terms');
                                            var button = document.getElementById('submit');
                                            if(checkbox.checked == true){
                                                button.disabled = false;
                                                // console.log('yes');   
                                            }else{
                                                button.disabled = true;
                                                // console.log('no');
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" style="width:100%" id="submit" class="btn btn-maroon  " onclick="return Validate()" disabled>
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div  class="text-center mt-3">
                                <p class="maroon">Already Have an Account? <a href="/login"><u>Sign In</u> </a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password-confirm").value;
        if (password != confirmPassword) {
            alert("Passwords and Confirm Password do not match.");
            return false;
        }
        return true;
    }
</script>