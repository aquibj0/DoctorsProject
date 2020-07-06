<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceRequest;
use App\Service;
use App\Patient;
use App\AskAQuestion;
use App\User;
use Carbon\Carbon;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function response($id, Request $request){
        $aaq = AskAQuestion::find($id);
        $aaq->aaqDocResponse = $request['response'];
        $aaq->update();

        $srvcReq = ServiceRequest::find($aaq->service_req_id);
        $srvcReq->srResponseDateTime = Carbon::now();
        $srvcReq->update();

        return redirect('/admin/dashboard')->with('success', 'Added Response to Service Request ID :'.$srvcReq->srId.'!');
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
                return view('admin.ask-a-question')->with('srvcReq', $srvcReq)->with('patient', $patient)->with('aaq', $asaq);
            }
            // $asaq = AskAQuestion::find($srvcReq->)
        }else{
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