<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceRequest;
use App\Service;
use App\Patient;
use App\AskAQuestion;
use App\User;
use App\Admin;
use Auth;
use Carbon\Carbon;
use App\Jobs\SendEmail;

class ServiceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    public function query($query){
        if($query == "paid"){
            $result = ServiceRequest::where('paymentStatus', 1)->get();
            return $result;
        }
        if($query == "unpaid"){
            $result = ServiceRequest::whereNull('paymentStatus')->get();
            return $result;
        }
        if($query == "AAQ" || $query == "VED" || $query == "VTD" || $query == "CLI"){
            $service = Service::where('srvcShortName', $query)->first(); 
            $result = ServiceRequest::where('service_id', $service->id)->get();
            return $result;
        }
    }

    public function response($id, Request $request){
        $aaq = AskAQuestion::find($id);
        $aaq->aaqDocResponse = $request['response'];
        $aaq->update();

        $srvcReq = ServiceRequest::find($aaq->service_req_id);
        $srvcReq->srResponseDateTime = Carbon::now();
        $srvcReq->update();

        // $patient = $srvcReq->patient();
        $patient = Patient::find($srvcReq->patient_id);

        $user = User::find($srvcReq->user_id);

        SendEmail::dispatch($patient, $srvcReq, $aaq, $user, 2)->delay(now()->addMinutes(1));

        return redirect()->back()->with('success', 'Added Response to Service Request ID :'.$srvcReq->srId.'!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {
        $srvcReq = ServiceRequest::find($id);
        if(!empty($srvcReq)){
            // $service = Service::find($srvcReq->service_id);
            $patient = Patient::find($srvcReq->patient_id);
            // return strpos($srvcReq->srId, "AAQ");
            if(strpos($srvcReq->srId, "AAQ") == true){
                $asaq = AskAQuestion::find($srvcReq->servSpecificId);
                return view('admin.service-request-details')->with('srvcReq', $srvcReq)->with('patient', $patient)->with('aaq', $asaq);
            }
            // $asaq = AskAQuestion::find($srvcReq->)
        }
        else{
            return redirect('/admin/dashboard')->with('error', 'Service Request not found!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
