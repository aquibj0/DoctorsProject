<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
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
    // protected $redirectTo = '/home';



       public function __construct()
       {
           $this->middleware('guest:admin')->except('logout');
       }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.auth.login');
    }


    public function loginAdmin(Request $request)
    {
      // Validate the form data
      $validator = Validator::make($request->all(), [
        'email'   => 'required|email|exists:admins',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if(!$validator->fails()){
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
          // if successful, then redirect to their intended location
          return redirect()->intended(url('/admin'));
        }else{
          return redirect()->back()->withInput()->with('error','Wrong Password!');
        }
        // $admin = Admin::where('email', $request->email)->first();
      }else{
      // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput()->with('error', 'Email dosen\'t exists!');
      }
    }


    public function showAdmin($id){
      $internalUser = Auth::user()->find($id);
      return $internalUser;
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }
}