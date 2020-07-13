<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\AppointmentSchedule;

class AppointmentController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appointment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = array();
        foreach($request->time as $time){
            // $appmnt = AppointmentSchedule::where('appmntDate', $request->date)->where('appmntSlot', $time)->where('appmntType', $request->appType)->where('appmntSlotFreeCount','<', 5)->get();
            // if($appmnt){
                $app = new AppointmentSchedule;
                $app->appmntType = $request->appType;
                // $app->appmntClinicid = 
                if($request->appType == "CLI")
                    $app->
                $app->appmntDate = $request->date;
                $app->appmntSlot = $time;
                $app->appmntSlotMaxCount = 5;
                $app->appmntSlotFreeCount = 5;
                $app->save();
            // }else{
            //     $msg = "Cannot Update!! Appointment exists on ".$request->date." ".$time." for ".$request->appType.".";
            //     array_push($errors, $msg);
            // }
        }
        if(!$errors){
            return redirect('/admin')->with('success', 'Appointment Added/Updated Successfully!');
        }else{
            return redirect('/admin/appointment/create')->with('error', $errors)->withInputs();
        }
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
