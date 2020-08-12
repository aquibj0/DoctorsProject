<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Mail\auth\PasswordForgetLink;
use App\Mail\auth\PasswordChangedLink;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function passwordReset(Request $request){
        if(isset($request->_token) && isset($request->email)){
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
            ]);
            if(!$validator->fails()){
                $user = User::where('userEmail', $request->email)->first();
                if(isset($user)){
                    DB::table('password_resets')->insert([
                        'email' => $request->email,
                        'token' => str_random(60),
                        'created_at' => Carbon::now()
                    ]);
                    $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
                    // $res = $this->sendResetEmail($request->email, $tokenData->token);
                    // $user = DB::table('users')->where('userEmail', $email)->select('userFirstName', 'userEmail')->first();
                    //Generate, the password reset link. The token generated is embedded in the link
                    $link = config('app.url', '127.0.0.1:8000') . '/password/reset/' . $tokenData->token . '?email=' . urlencode($user->userEmail);
                    // return $link;
                    try {
                        Mail::to($user->userEmail)->send(new PasswordForgetLink($user, $link));
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error','A Network Error occurred. Please try again. '.$e->getMessage());
                    }
                    return redirect()->back()->with('success', trans('A reset link has been sent to your email address.'));
                }else{
                    return redirect()->back()->with('error', 'Email not registered');
                }
            }else{
                return redirect()->back()->with('error', 'Invalid Email');
            }
        }else{
            return redirect()->back()->with('error', 'Something went wrong! Please try again later!');
        }
        return $request;
    }

    public function resetPassword(Request $request)
    {
        // return $request;
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,userEmail',
            'password' => 'required|confirmed',
            'token' => 'required',
        ]);

        // check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->with('error','Please complete the form');
        }

        $password = $request->password;// Validate the token
        $tokenData = DB::table('password_resets')->where('token',  $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return redirect('/password/reset')->with('error', 'Data not found! Please try again.');

        if(!Hash::check($request->token, $tokenData->token)){
            // return redirect('/password/reset')->with('error', 'Token mismatch error. Please try again.'); 
        }

        $user = User::where('userEmail', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);//Hash and update the new password
        $user->userPassword = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        // Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->userEmail)->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return redirect('/login')->with('success', 'Your password have been changed.');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }

    }

    public function sendSuccessEmail($email){
        $user = User::where('userEmail', $email)->first();
        try{
            Mail::to($user->userEmail)->send(new PasswordChangedLink($user));
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
