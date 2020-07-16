@extends('layouts.app')


@section('content')


    <div class="container">
            @include('layouts.message')
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="user-image" style="height:200px; width:100%; border-radius:12px">
                            @isset(Auth::user()->userImage)
                                <img src="{{asset('storage/'.Auth::user()->userImage)}}" style="border-radius:50%;max-width:70%" alt="">

                            @else
                                <img src="{{asset('image/user-profile.png')}}" style="max-width:60%" alt="">
                            @endisset
                        </div>
                        <a href="#" data-toggle="modal" data-target="#uploadImage" class="btn btn-maroon btn-sm mt-4" style="width:100%">Upload Picture</a>
                        <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('image.upload',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" name="userImage" id="userImage" class="form-control">
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
                            <h2>View User Profile</h2>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" value="{{Auth::user()->userFirstName}}" disabled>

                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" value="{{Auth::user()->userLastName}}" disabled>                                    
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" value="{{Auth::user()->userEmail}}" disabled>

                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" value="{{Auth::user()->userMobileNo}}" disabled>                                    
                                </div>
                            </div>

                        </form>


                        <div class="button mt-4">

                            <a href="#" class="btn btn-maroon btn-sm" data-toggle="modal"  data-target="#exampleModal">Update Password</a>

      
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <form action="{{ route('changePassword') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    
                                            <div class="col-md-12">
                                                <label for="new-password" >Current Password</label>

                                                <input id="current-password" type="password" class="form-control" name="current-password" required>
                
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

                                                <input id="new-password" type="password" class="form-control" name="new-password" required>
                
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
                                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
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
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection