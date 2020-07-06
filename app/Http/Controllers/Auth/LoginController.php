<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_user(Request $request){
        if($request){
            if(User::where('userMobileNo', $request['email'])->first()){
                $user = User::where('userMobileNo', $request['email'])->first();
                if(Hash::check($request['password'], $user->userPassword)){
                    Auth::login($user);
                    return redirect('/');
                }else{
                    
                }
            }
            else if(User::where('userEmail', $request['email'])->first()){
                $user = User::where('userEmail', $request['email'])->first();
                if(Hash::check($request['password'], $user->userPassword)){
                    Auth::login($user);
                    return redirect('/');
                }
            }
            else{
                return redirect('/login')->with('status', 'Email/Phone No or password input mismatch!');
            }
        }
    }
}
