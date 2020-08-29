@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="register-block mt-4">
                <h2 class="mb-0"> <b>{{ __('Reset Password') }}</b></h2> 
            </div>
            <div class="card">

                <div class="card-body">
                    @include('layouts.message')

                    <form method="POST" action="{{ url('/password-reset') }}">
                        {{ csrf_field() }}
                        <div class="row form-group">
                            <div class="col-md-5">
                                <h2 style="text-align: center">Enter E-Mail Address</h2>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-8">
                                <input id="userEmail" type="email" class="form-control" style="border-bottom: 1px solid maroon; text-align: center" placeholder="jhon@something.com" name="userEmail" value="{{ old('userEmail') }}" required autocomplete="userEmail" autofocus>

                                @error('userEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4.5">
                                <button type="submit" class="btn btn-md btn-maroon" style="text-align: center">
                                    <h5><b>Send Password Reset Link</b></h5>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
