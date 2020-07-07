<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($service)
    {
        $patients = Patient::where('user_id', Auth::user()->id)->get();
        if($patients){
            return view('patient.index')->with('patients', $patients)->with('service', $service);
        }else{
            return redirect('ask-doctor.index')->with('patient', null);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
        // return "Hey, How's it going?";
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
        $patient->user_id = Auth::user()->id;
        $patient->save();
        $patient->patId = Auth::user()->userId."-".$patient->id;
        $patient->update();
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
