@extends('admin.layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div>
        <div class="col-md-8" style=" height:100vh;">
             --}}
            <div class="row">
                <div class="col-md">
                    <div class="ask-dcotor-form">
                        <div class="register-block">
                           <h2> Hello Admin!</h2>
                        </div>
                        <div>
                            <h3>Make Internal User</h3>
                            {{-- <form action="{{ url('/change-user-to-internal') }}" method="POST">
                                <label for="make_internal">Select user </label>
                                <select name="user_id" id="user_id">
                                    <option value="0">Select One</option>
                                    @foreach(App\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->userFirstName }}&nbsp;{{ $user->userLastName }}</option>
                                    @endforeach
                                </select>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>     
        
        </div>
    </div>


</section>




@endsection