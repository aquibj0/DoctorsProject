<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Patient;
use App\ServiceRequest;
// use App\Patient
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function userServiceRequest($id){
        $user = User::where('id', $id)->first();

        if(Auth::user()->id == $id){

            $serviceRequests = ServiceRequest::where('user_id', '=', $id)->get();
            return view('user.service_request', compact('serviceRequests'));
        }


    }



    public function serviceRequestDetail($id, $srId){
        $user = User::where('id', $id)->first();
        $serviceRequests = ServiceRequest::where('srId', '=', $srId)->first();
        if(Auth::user()->id == $id){
            return view('user.service_request_details', compact('serviceRequests'));
        }
    }


    public function show($id){
        $user = Auth::user()->where('id', $id)->first();
        return view('user.show',compact('user'));
    }


    public function update(Request $request, $id){
    }


    // Function to change password
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->userPassword))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->userPassword = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function updateImage( Request $request, $id){
        if($request){
            $user = Auth::user()->where('id', $id)->first();
            if($request->hasFile('userImage')){
                $user->userImage = $request->file('userImage')->store('userImage','public');
            }
            $user->update();
            return redirect()->back()->with('success', 'Image successfull Uploaded');
        }
    }


}
