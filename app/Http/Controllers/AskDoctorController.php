<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\AskAQuestion;
use App\Patient;
use App\ServiceRequest;
use Auth;

class AskDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ask-doctor.index');
    }


    public function doctor_index(){
        $aaq_srvcReq = AskAQuestion::all()->pluck('aaqSrId');
        $aaq = AskAQuestion::all();
        $srvcReq = ServiceRequest::whereIn('id', $aaq_srvcReq)->get();
        return view('ask-doctor.admin_index')->with('aaq', $aaq)->with('srvcReq', $srvcReq);
    }


    public function doctor_respones($id, Request $request){
        $aaq = AskAQuestion::find($id);
        $aaq->aaqDocResponse = $request['response'];
        $aaq->update();

        $srvcReq = ServiceRequest::find($aaq->aaqSrId);
        $srvcReq->srResponseDateTime = $aaq->updated_at;
        $srvcReq->update();

        return array($aaq, $srvcReq);
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
        $patient = new Patient;
        $patient->patFirstName = $request['firstName'];
        $patient->patLastName = $request['lastName'];
        $patient->patGender = $request['gender'];
        $patient->patAge = $request['age'];
        $patient->patUserId = Auth::user()->id;
        $patient->save();
        
        $srvcReq = new ServiceRequest;
        $srvcReq->srPatientId = $patient->id;
        $srvcReq->srUserId = Auth::user()->id;
        $srvcReq->srRecievedDateTime = Carbon::now();
        $srvcReq->srDueDateTime = Carbon::tomorrow();
        $srvcReq->srDepartment = $request['department'];
        // $srvcReq->
        $srvcReq->save();
        
        $asaq = new AskAQuestion;
        $asaq->aaqSrId = $srvcReq->id;
        $asaq->aaqPatientBackground = $request['patient_background'];
        $asaq->aaqQuestionText = $request['patient_question'];
        
        $asaq->save();

        

        

        
        // $asaq->update();
        return array($asaq, $patient, $srvcReq);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function doctor_show($id){
        $aaq = AskAQuestion::find($id);
        $srvcReq = ServiceRequest::find($aaq->aaqSrId);
        $patient = Patient::find($srvcReq->srPatientId);
        return view('ask-doctor.admin_show')->with('aaq', $aaq)->with('srvcReq', $srvcReq)->with('patient', $patient);
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
