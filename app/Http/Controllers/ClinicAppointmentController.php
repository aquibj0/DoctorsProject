<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Carbon\Carbon;

class ClinicAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $patient = Patient::find($id);
        $time = Carbon::createFromFormat('H:i:s', '09:00:00');
        $end = Carbon::createFromFormat('H:i:s', '17:00:00');
        if($patient)
            return view('clinic-appointment.index')->with('patient', $patient)->with('time', $time)->with('end', $end);
        else
            return view('clinic-appointment.index')->with('patient', null)->with('time', $time)->with('end', $end);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
