@extends('admin.layouts.app')

@section('content')
<div class="container">
        <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="register-block">
                        <h2>Internal User Register</h2>
                    </div>
                </div>
            </div>
    <div class="row">
        {{-- <div class="col-md-4">

        </div> --}}
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                
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

                            <form  method="POST" action="{{ route('admin.register.user.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                    <label for="firstName" class="col-md-4 control-label">First Name</label>

                                    <div class="col-md">
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

                                    <div class="col-md">
                                        <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>

                                        @if ($errors->has('lastName'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">Gender</label>

                                    <div class="col-md">
                                        {{-- <input id="gender" type="text" class="form-control" name="gender" value="{{ old('gender') }}" required autofocus> --}}
                                        <select name="gender" id="gender" class="form-control" required>
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
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('phoneNo') ? ' has-error' : '' }}">
                                    <label for="phoneNo" class="col-md-4 control-label">Phone number</label>

                                    <div class="col-md">
                                        <input id="phoneNo" type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}" required autofocus onkeypress='validate(event)' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                        <script>
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
                                        @if ($errors->has('phoneNo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phoneNo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category" class="col-md-4 control-label">Category</label>

                                    <div class="col-md">
                                        {{-- <input id="phoneNo" type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}" required autofocus> --}}
                                        <select name="category" id="category" class="form-control" required>
                                            @if(old('category') == "doc")
                                                <option disabled>Select one</option>
                                                <option value="doc" selected>Doctor</option>
                                                <option value="admin">Admin</option>
                                                <option value="others">Others Staff</option>
                                            @elseif(old('category') == "admin")
                                                <option disabled>Select one</option>
                                                <option value="doc">Doctor</option>
                                                <option value="admin" selected>Admin</option>
                                                <option value="others">Others Staff</option>
                                            @elseif(old('category') == "others")
                                                <option disabled>Select one</option>
                                                <option value="doc">Doctor</option>
                                                <option value="admin">Admin</option>
                                                <option value="others" selected>Others Staff</option>
                                            @else
                                                <option selected disabled>Select one</option>
                                                <option value="doc">Doctor</option>
                                                <option value="admin">Admin</option>
                                                <option value="others">Others Staff</option>
                                            @endif
                                            
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                    <label for="department" class="col-md-4 control-label">Department</label>

                                    <div class="col-md-6">
                                        <select name="department" id="department" class="form-control">
                                            <option selected disabled>Select one</option>
                                            @foreach($depts as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md">
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
                                    <div class="col-md mt-4">
                                        <button type="submit" class="btn btn-maroon" style="width:100%">
                                            Submit
                                        </button>

                                        <div class="text-center mt-3">
                                            <a href="{{ url()->previous() }}" class=" text-center mt-4 mb-2"><u>Back</u></a>
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