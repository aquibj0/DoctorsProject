<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\AskAQuestion;
use App\Patient;
use App\ServiceRequest;
use Auth;
use App\Service;
// use Carbon\Carbon;

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
        $aaq_srvcReq = AskAQuestion::all()->pluck('service_req_id');
        $aaq = AskAQuestion::all();
        $srvcReq = ServiceRequest::whereIn('id', $aaq_srvcReq)->get();
        return view('ask-doctor.admin_index')->with('aaq', $aaq)->with('srvcReq', $srvcReq);
    }


    public function doctor_respones($id, Request $request){
        $aaq = AskAQuestion::find($id);
        $aaq->aaqDocResponse = $request['response'];
        $aaq->update();

        $srvcReq = ServiceRequest::find($aaq->service_req_id);
        $srvcReq->srResponseDateTime = Carbon::now();
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
        $patient->patId = str_random(15);
        $patient->user_id = Auth::user()->id;
        $patient->patFirstName = $request['firstName'];
        $patient->patLastName = $request['lastName'];
        $patient->patGender = $request['gender'];
        $patient->patAge = $request['age'];
        $patient->patBackground = $request['background'];
        $patient->save();
        $patient->patId = Auth::user()->id."-".$patient->id;
        $patient->update();


        if($patient->save()){
            $srvcReq = new ServiceRequest;
            $srvcReq->service_id = Service::where('srvcShortName', 'AAQ')->first()->id;
            $srvcReq->patient_id = $patient->id;
            $srvcReq->user_id = Auth::user()->id;
            $srvcReq->srRecievedDateTime = Carbon::now();
            $srvcReq->srDueDateTime = Carbon::now()->addHours(24);
            $srvcReq->srDepartment = $request['department'];
            $srvcReq->save();
            $srvcReq->srId = "SR00".$srvcReq->id."AAQ";
            $srvcReq->update();


            $srvdID = $srvcReq->srId ;


            if($srvcReq->save()){
                $asaq = new AskAQuestion;
                $asaq->service_req_id = $srvcReq->id;
                $asaq->aaqPatientBackground = $request['patient_background'];
                $asaq->aaqQuestionText = $request['patient_question'];
                $asaq->aaqDocResponseUploaded = 'N';
                $asaq->save();

                return redirect()->route('confirm-service-request', $srvdID);
                // ->with('success', 'Your Booking is done, Please pay to confirm.');
            }
        }

   



        
        

        

        
        // $asaq->update();
        // return array($asaq, $patient, $srvcReq);
    }



    public function serviceBooking($srvdID){
        $serviceRequest = ServiceRequest::where('srId', $srvdID )->first();
        return view('ask-doctor.booking', compact('serviceRequest'));
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
        $srvcReq = ServiceRequest::find($aaq->service_req_id);
        $patient = Patient::find($srvcReq->patient_id);
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
