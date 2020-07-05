<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Patient;
use App\ServiceRequest;

class UserController extends Controller
{
    public function userServiceRequest($id){
        $user = User::where('id', $id)->first();

        if(Auth::user()->id == $id){
            $serviceRequests = ServiceRequest::where('user_id', '=', $id)->get();
            if(isset($serviceRequests)){
                return view('user.service_request', compact('serviceRequests'));
            }
            else{
                return 'No Data FOund';
            }
        }


    }



    public function serviceRequestDetail($id, $srId){
        $user = User::where('id', $id)->first();
        $serviceRequests = ServiceRequest::where('srId', '=', $srId)->first();
        if(Auth::user()->id == $id){
            return view('user.service_request_details', compact('serviceRequests'));
        }
    }
}
