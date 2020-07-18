@extends('layouts.app')

@section('content')

<div class="row" >
    <div class="col-md-4" >
        <img src="{{asset('image/IMAGE4.jpg')}}" style="max-width:100%" alt="">
    </div>
    <div class="col-md-8">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-login-form">
                        <div class="register-block mt-4">
                            <h2 class="mb-0"> <b>LOGIN</b></h2> 
                        </div>
                        @include('layouts.message')

                        <div class="mt-4">
                            <form method="POST" action="{{ route('login_user') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <div class="col-md-12">
                                            <input id="email" type="text" placeholder="Email or Mobile No." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
            
                                <div class="form-group row">
                                    
                                    <div class="col-md-11">
                                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
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
                                    <div class="col-md-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" style="width:100%" class="btn btn-maroon">
                                            {{ __('Login') }}
                                        </button>
        
                                        <div class="text-center mt-2">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    <u>{{ __('Forgot Your Password?') }}</u>
                                                </a>
                                            @endif
                                            <br>
                                            <p>New User? <a href="/register"><u>Register Here</u></a></p>
                                        </div>
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

@endsection
