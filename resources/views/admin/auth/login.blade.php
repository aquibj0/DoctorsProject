@extends('admin.layouts.app')

@section('title', 'Admin Login')


@section('content')
<section>
    <div class="row">
        <div class="col-md-4" style="background:#142cd6; height:100vh"></div>
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="user-login-form">
                            <div class="register-block mt-5">
                                <h2 class="mb-0"> <b>Admin Login</b></h2> 
                            </div>
                            <div class="mt-4">
                                @include('layouts.message')
                                <form method="POST" action="{{ route('admin.auth.loginAdmin') }}">
                                    {{ csrf_field() }}
            
                                    <div class="form-row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}
            
                                        <div class="col-md-12">
                                            <input id="email" type="email" placeholder="Email/Phone No." class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class=" form-row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}
            
                                        <div class="col-md-11">
                                            <input id="password"  type="password" placeholder="Password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md">
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
                                    
                                    <div class="form-row form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class=" form-row form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-maroon" style="width:100%">
                                                Login
                                            </button>
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