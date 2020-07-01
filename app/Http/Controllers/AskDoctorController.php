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
        return view('ask-doctor.admin_index');
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
        $asaq = new AskAQuestion;
        $asaq->aaqPatientBackground = $request['patient_background'];
        $asaq->aaqQuestionText = $request['patient_question'];
        
        $asaq->save();

        $patient = new Patient;
        $patient->patFirstName = $request['firstName'];
        $patient->patLastName = $request['lastName'];
        $patient->patGender = $request['gender'];
        $patient->patAge = $request['age'];
        $patient->patUserId = Auth::user()->id;
        $patient->save();

        $srvcReq = new ServiceRequest;
        $srvcReq->srPatientId = $patient->idSequence;
        $srvcReq->srUserId = Auth::user()->id;
        $srvcReq->srRecievedDateTime = $asaq->created_at;
        $srvcReq->srDueDateTime = Carbon::tomorrow();
        $srvcReq->srDepartment = $request['department'];
        // $srvcReq->
        $srvcReq->save();
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
