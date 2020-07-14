<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration data.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'userFirstName' => $data['firstName'],
            'userLastName' => $data['lastName'],
            'userMobileNo' => $data['mobile'],
            // 'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function create_user(Request $request){

        
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:40'],
            'lastName' => ['required', 'string', 'max:40'],
            'userEmail' => ['string', 'email', 'max:100', 'unique:users'],
            'userMobileNo' => ['required', 'numeric',  'digits:10', 'unique:users'],
            'userLandLineNo'  => ['numeric',  'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        
        if(!$validator->fails()){
            $user = new User;
            $user->userFirstName = $request['firstName'];
            $user->userLastName = $request['lastName'];
            $user->userMobileNo = $request['userMobileNo'];
            $user->userLandLineNo = $request['userLandLineNo'];
            $user->userEmail = $request['userEmail'];
            $user->userType = "E";
            $user->userPassword = Hash::make($request['password']);
            $user->save();
            $user->userId = "UID".$user->id;
            $user->update();
            Auth::login($user);
            return redirect('/')->with('success', $user->userFirstName.', your registration is successfull');
        }else{
            return redirect('/register')->withErrors($validator)->withInput();
        }
    }
}
