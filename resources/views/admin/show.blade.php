@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="user-image" style="height:200px; width:100%; border-radius:12px">
                            @isset(Auth::user()->display_image)
                                <img src="{{asset('storage/'.Auth::user()->display_image)}}" style="max-width:150px" alt="">

                            @else
                                <img src="{{asset('image/user-profile.png')}}" style="max-width:150px;" alt="">
                            @endisset
                        </div>
                        <a href="#" data-toggle="modal" id="uploadDocumentButton" data-target="#uploadImage" class="btn btn-maroon btn-sm mt-4" style="width:100%">Upload Picture</a>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function(){
                                var x = "{{ $errors->has('display_image') }}"
                                if(x === "1"){
                                    document.getElementById("uploadDocumentButton").click();
                                }
                            });
                        </script>
                        <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('admin.image.upload', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input id="display_image" type="file" placeholder="Document Filename" class="form-control @error('display_image') is-invalid @enderror" name="display_image" value="{{ old('display_image') }}"  autocomplete="display_image" autofocus>
                                            @error('display_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-maroon btn-sm" >Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="register-block">
                            <h2>Internal User Profile</h2>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                @include('layouts.message')
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >First Name</label> --}}
                                    <input class="form-control" type="text" value="{{Auth::user()->firstName}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Last Name</label> --}}
                                    <input class="form-control" type="text" value="{{Auth::user()->lastName}}" disabled>                                    
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Email</label> --}}
                                    <input class="form-control" type="text" value="{{Auth::user()->email}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Phone No</label> --}}
                                    <input class="form-control" type="text" value="{{Auth::user()->phoneNo}}" disabled>                                    
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Alternate Phone No</label> --}}
                                    <input class="form-control" type="text" placeholder="Alternate Phone No." value="{{Auth::user()->alternatePhoneNo}}" disabled>
                                </div>
                                {{-- <div class="col-md-6">
                                    <input class="form-control" type="date" value="{{Auth::user()->dob}}" disabled>                                    
                                </div> --}}
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Degree</label> --}}
                                    <input class="form-control" type="text" placeholder="Degree" value="{{Auth::user()->degree}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Date of Birth</label> --}}
                                    <input class="form-control" type="text" placeholder="DOB" value="{{Carbon\Carbon::parse(Auth::user()->dob)->format('d-m-Y')}}" disabled>                                    
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Address Line 1</label> --}}
                                    <input class="form-control" type="text" placeholder="Address Line 1" value="{{Auth::user()->addressLine1}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Address Line 2</label> --}}
                                    <input class="form-control" type="text" placeholder="Address Line 2" value="{{Auth::user()->addressLine2}}" disabled>                                    
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >City</label> --}}
                                    <input class="form-control" type="text" placeholder="City" value="{{Auth::user()->city}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >District</label> --}}
                                    <input class="form-control" type="text" placeholder="District" value="{{Auth::user()->district}}" disabled>                                    
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >State</label> --}}
                                    <input class="form-control" type="text" placeholder="State" value="{{Auth::user()->state}}" disabled>
                                </div>
                                <div class="col-md-6">
                                    {{-- <label for="new-password" >Country</label> --}}
                                    <input class="form-control" type="text" placeholder="Country" value="{{Auth::user()->country}}" disabled>                                    
                                </div>
                            </div>
                            
                        </form>

                        <div class="row">
                        <div class="button col-md-3 mt-4 mb-4">

                            <a href="#" class="btn btn-maroon btn-md" data-toggle="modal" id="updatePassword"  data-target="#exampleModal">Update Password</a>
                            <script>
                                $(document).ready(function(){
                                    var x = "{{ $errors->has('current-password') }}";
                                    var y = "{{ $errors->has('new-password') }}";
                                    if(x === "1" || y === "1" || "{{ $message = Session::get('passerror') }}"){
                                        document.getElementById("updatePassword").click();
                                    }
                                });
                            </script>
      
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Update Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @if ($message = Session::get('passerror'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                <form action="{{ route('admin.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    
                                            <div class="col-md-12">
                                                <label for="new-password" >Current Password</label>

                                                <input id="current-password" type="password" class="form-control" name="current-password"  value="{{old('current-password')}}" required>
                
                                                @if ($errors->has('current-password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('current-password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                        
                                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                
                                            <div class="col-md-12">
                                                <label for="new-password" >New Password</label>

                                                <input id="new-password" type="password" class="form-control" name="new-password" value="{{old('new-password')}}" required>
                
                                                @if ($errors->has('new-password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('new-password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                        
                                        <div class="form-group">
                
                                            <div class="col-md-12">
                                                <label for="new-password-confirm" >Confirm New Password</label>
                                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" value="{{old('new-password_confirmation')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-maroon btn-sm">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="button col-md-3 mt-4 mb-4">
                            <a href="#" class="btn btn-maroon btn-md" data-toggle="modal" id="updateProfile" data-target="#profileModal">Update Profile</a>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function(){
                                    if("{{ $errors->has('firstName') }}" === "1" || "{{ $errors->has('lastName') }}" === "1" || "{{ $errors->has('phoneNo') }}" === "1" || "{{ $errors->has('alternatePhoneNo') }}" === "1" || "{{ $errors->has('degree') }}" === "1" || "{{ $errors->has('dob') }}" === "1" || "{{ $errors->has('addressLine1') }}" === "1" || "{{ $errors->has('addressLine2') }}" === "1" || "{{ $errors->has('city') }}" === "1"|| "{{ $errors->has('district') }}" === "1"|| "{{ $errors->has('state') }}" === "1"|| "{{ $errors->has('country') }}" === "1"){
                                        document.getElementById("updateProfile").click();
                                    }
                                });
                            </script>
                            <!-- Modal -->
                            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <form action="/admin/update-profile" method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >First Name</label>
                                                            @if(old('firstName'))
                                                            <input class="form-control" type="text" name="firstName" value="{{old('firstName')}}">
                                                            @else
                                                            <input class="form-control" type="text" name="firstName" value="{{Auth::user()->firstName}}">
                                                            @endif
                                                            @if ($errors->has('firstName'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('firstName') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Last Name</label>
                                                            @if(old('lastName'))
                                                            <input class="form-control" type="text" name="lastName" value="{{old('lastName')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="lastName" value="{{Auth::user()->lastName}}">                                    
                                                            @endif
                                                            @if ($errors->has('lastName'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('lastName') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                        
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Phone No</label>
                                                            @if(old('phoneNo'))
                                                            <input class="form-control" type="text" name="phoneNo" value="{{old('phoneNo')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="phoneNo" value="{{Auth::user()->phoneNo}}">                                    
                                                            @endif
                                                            @if ($errors->has('phoneNo'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('phoneNo') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Alternate Phone No</label>
                                                            @if(old('alternatePhoneNo'))
                                                            <input class="form-control" type="text" name="alternatePhoneNo" placeholder="Alternate Phone No." value="{{old('alternatePhoneNo')}}">
                                                            @else
                                                            <input class="form-control" type="text" name="alternatePhoneNo" placeholder="Alternate Phone No." value="{{Auth::user()->alternatePhoneNo}}">                                    
                                                            @endif
                                                            @if ($errors->has('alternatePhoneNo'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('alternatePhoneNo') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Degree</label>
                                                            @if(old('degree'))
                                                            <input class="form-control" type="text" name="degree" placeholder="Degree" value="{{old('degree')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="degree" placeholder="Degree" value="{{Auth::user()->degree}}">                                    
                                                            @endif
                                                            @if ($errors->has('degree'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('degree') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Date of Birth</label>
                                                            @if(isset(Auth::user()->dob))
                                                                <input class="form-control" type="date" placeholder="DOB" name="dob" value="{{Carbon\Carbon::parse(Auth::user()->dob)->toDateString()}}" max="{{ Carbon\Carbon::today()->toDateString() }}">                                        
                                                            @elseif(old('dob'))
                                                                <input class="form-control" type="date" placeholder="DOB" name="dob" value="{{old('dob')}}"  max="{{ Carbon\Carbon::today()->toDateString() }}">                                    
                                                            @else
                                                                <input class="form-control" type="date" placeholder="DOB" name="dob" value="" max="{{ Carbon\Carbon::yesterday()->toDateString() }}">                                    
                                                            @endif
                                                                                                
                                                            @if ($errors->has('dob'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Address Line 1</label>
                                                            @if(old('addressLine1'))
                                                            <input class="form-control" type="text" name="addressLine1" placeholder="Address Line 1" value="{{old('addressLine1')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="addressLine1" placeholder="Address Line 1" value="{{Auth::user()->addressLine1}}">                                    
                                                            @endif
                                                            @if ($errors->has('addressLine1'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('addressLine1') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Address Line 2</label>
                                                            @if(old('addressLine2'))
                                                            <input class="form-control" type="text" name="addressLine2" placeholder="Address Line 2" value="{{old('addressLine2')}}">                                                                        
                                                            @else
                                                            <input class="form-control" type="text" name="addressLine2" placeholder="Address Line 2" value="{{Auth::user()->addressLine2}}">                                                                        
                                                            @endif
                                                            @if ($errors->has('addressLine2'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('addressLine2') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >City</label>
                                                            @if(old('city'))
                                                            <input class="form-control" type="text" name="city" placeholder="City" value="{{old('city')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="city" placeholder="City" value="{{Auth::user()->city}}">                                    
                                                            @endif
                                                            @if ($errors->has('city'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('city') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >District</label>
                                                            @if(old('district'))
                                                            <input class="form-control" type="text" name="district" placeholder="District" value="{{old('district')}}">                                                                        
                                                            @else
                                                            <input class="form-control" type="text" name="district" placeholder="District" value="{{Auth::user()->district}}">                                                                        
                                                            @endif
                                                            @if ($errors->has('district'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('district') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-md-6">
                                                            <label for="new-password" >State</label>
                                                            @if(old('state'))
                                                            <input class="form-control" type="text" name="state" placeholder="State" value="{{old('state')}}">                                    
                                                            @else
                                                            <input class="form-control" type="text" name="state" placeholder="State" value="{{Auth::user()->state}}">                                    
                                                            @endif
                                                            @if ($errors->has('state'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('state') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="new-password" >Country</label>
                                                            <Select class="form-control" name="country">
                                                                <option value="India" selected>India</option>
                                                            </Select>
                                                                                                
                                                            @if ($errors->has('country'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('country') }}</strong>
                                                                </span>
                                                            @endif
                                                            {{-- <input class="form-control" type="text" name="country" placeholder="Country" value="{{Auth::user()->country}}">                                     --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit    " class="btn btn-maroon btn-sm">Save changes</button>
                                        </div>
                                    </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection