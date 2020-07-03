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
            $serviceRequests = ServiceRequest::where('srUserId', '=', $id)->get();
            return view('user.service_request', compact('serviceRequests'));
        }


    }



    public function serviceRequestDetail($id, $srId){
        $user = User::where('id', $id)->first();
        $serviceRequests = ServiceRequest::where('srSrvcId', '=', $srId)->first();
        if(Auth::user()->id == $id){
            return view('user.service_request_details', compact('serviceRequests'));
        }
    }
}
