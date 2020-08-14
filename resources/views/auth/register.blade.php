@extends('layouts.app')

@section('content')

<div class="row" >
    <div class="col-md-4">
        <img style="max-width:100%" src="{{asset('image/IMAGE3.jpg')}}" alt="">
    </div>
    <div class="col-md-8">
        <div class="container">
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
                                <div class="form-row form-group">

                                    <div class="col-md-6" >
                                        <input id="firstName" type="text" placeholder="First Name" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                        @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6" >
                                        <input id="lastName" type="text" placeholder="Last Name" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                        @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <div class="col-md-6">
                                        <div class="mr-1" >
                                            <input id="userMobileNo" onkeypress='validate(event)' type="text" placeholder="Mobile No." class="form-control @error('userMobileNo') is-invalid @enderror" name="userMobileNo" value="{{ old('userMobileNo') }}" required autocomplete="userMobileNo" autofocus oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
    
                                            @error('userMobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6" > 
                                        <input id="userLandLineNo" onkeypress='validate(event)' type="text" placeholder="Landline No." class="form-control @error('userLandLineNo') is-invalid @enderror" name="userLandLineNo" value="{{ old('userLandLineNo') }}" autocomplete="userLandLineNo" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">

                                        @error('userLandLineNo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row form-group" >
                                    <div class="col-md">
                                            <input id="userEmail" type="email" placeholder="Email" class="form-control @error('userEmail') is-invalid @enderror" name="userEmail" value="{{ old('userEmail') }}" autocomplete="userEmail">
                                            
                                            @error('userEmail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
        
                                <div class="form-row form-group">
                                    <div class="col-md">
                                        <div class="input-group">
                                            <input id="password" placeholder="Password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <button type="button" onclick="myFunction()"class="btn btn-eye" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div style="width:5%; float:right">
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
                                    </div> --}}
                                </div>
        
                                <div class="form-row form-group">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <button type="button" onclick="myFunctions()"class="btn btn-eye" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>                                            
                                        </div>
                                    </div>
                                    {{-- <div style="width:5%;">
                                        <input style="float:right" type="checkbox" class="form-control" onclick="myFunctionConfirm()">
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
                                    </div> --}}
                                </div>
                                
                                <div class="form-row form-group">
                                    <div class="col-md-12">
                                        <input type="checkbox" id="terms" onchange="confirm()">
                                        <label for="">I Agree with all the statements in <a href="#" data-toggle="modal" data-target="#termsandconditions"><u>Terms of Services</u></a></label>
                                        
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

                                        <div class="modal fade bd-example-modal-lg" id="termsandconditions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title maroon"><b>TERMS AND CONDITIONS</b></h5>
                                                            {{-- <h5 class="modal-title" id="exampleModalLabel">New message</h5> --}}
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    <div class="modal-body">
                                                        <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab incidunt, quam velit aliquam fuga quos eveniet molestias doloremque expedita quibusdam pariatur quae ipsa maiores nulla cumque porro numquam ducimus quia. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit dolore dolor asperiores, ipsam culpa et atque maiores porro cupiditate doloribus dicta delectus eos numquam quaerat voluptates cumque deleniti placeat dolores!</p>
                                                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda ipsam odio harum voluptates earum sed debitis vero est pariatur, commodi possimus sequi porro doloribus excepturi consectetur minima necessitatibus perspiciatis cum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ea, placeat facilis ab aperiam quam repudiandae explicabo ipsum eum, vitae illum alias facere fugiat non repellat dolorum. Fugit, facere velit.</p>
                                                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. In possimus exercitationem quisquam id inventore libero odio atque? Sapiente, accusantium incidunt magnam fugiat quibusdam rem quo architecto similique fuga, maxime laboriosam? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure quam aut ex fugiat facere dignissimos magni minus placeat. Aliquam veniam voluptas optio adipisci nesciunt libero consectetur minus deserunt quam illum.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        {{-- <button type="button" class="btn btn-primary">Send message</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" style="width:100%" id="submit" class="btn btn-maroon  " onclick="return Validate()" disabled>
                                            {{ __('Submit') }}
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
</div>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    } 

    function myFunctions() {
        var x = document.getElementById("password-confirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    } 
</script>

@endsection
{{-- <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password-confirm").value;
        if (password != confirmPassword) {
            alert("Passwords and Confirm Password do not match.");
            return false;
        }
        return true;
    }
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
</script> --}}
