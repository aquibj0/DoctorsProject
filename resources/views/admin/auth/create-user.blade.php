@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Register</div>

                <div class="panel-body">
                    @include('layouts.message')
                    <div class="card">
                        <div class="card-body">
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                            <form class="form-horizontal" method="POST" action="{{ route('admin.register.user.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                    <label for="firstName" class="col-md-4 control-label">First Name</label>

                                    <div class="col-md-6">
                                        <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>

                                        @if ($errors->has('firstName'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                    <label for="lastName" class="col-md-4 control-label">Last Name</label>

                                    <div class="col-md-6">
                                        <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>

                                        @if ($errors->has('lastName'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phoneNo') ? ' has-error' : '' }}">
                                    <label for="phoneNo" class="col-md-4 control-label">Phone number</label>

                                    <div class="col-md-6">
                                        <input id="phoneNo" type="number" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}" required autofocus oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">

                                        @if ($errors->has('phoneNo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phoneNo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category" class="col-md-4 control-label">Category</label>

                                    <div class="col-md-6">
                                        {{-- <input id="phoneNo" type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}" required autofocus> --}}
                                        <select name="category" id="category" class="form-control">
                                            <option selected disabled>Select one</option>
                                            <option value="doc">Doctor</option>
                                            <option value="asis">Assistance</option>
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                    <label for="department" class="col-md-4 control-label">Department</label>

                                    <div class="col-md-6">
                                        {{-- <input id="phoneNo" type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}" required autofocus> --}}
                                        <select name="department" id="department" class="form-control">
                                            <option selected disabled>Select one</option>
                                            <option value="value1">value 1</option>
                                            <option value="value2">value 2</option>
                                            <option value="value3">value 3</option>
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="    " class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
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
@endsection