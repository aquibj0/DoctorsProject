<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Clinic;
use App\Service;
use App\AppointmentSchedule;
use Illuminate\Support\Facades\DB;

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
        // $appointments = AppointmentSchedule::orderBy('created_at', 'desc')->get();
        // return $appointments;
        $clinics = Clinic::all();
        return view('admin.appointment.index')->with('clinics', $clinics)->with('show', 0);
    }

    public function check(Request $request){
        $start = Carbon::parse($request->start_date)->toDateString();
        $end = Carbon::parse($request->end_date)->toDateString();
        $docType = $request->doctor_type;
        $appmntType = $request->appointment_type;
        $data = array();
        for($date = Carbon::parse($request->start_date), $i=0 ; $date <= Carbon::parse($request->end_date); $date->addDays(1), $i++){
            $data[$i]['date'] = $date->isoFormat('D MMMM YYYY');
            $data[$i]['day'] = Carbon::parse($date)->isoFormat('dddd');
            if($appmntType == "VED"){
                if($docType == "ED"){
                    if(AppointmentSchedule::where('appmntType', 'VED')->where('appmntDate', $date->toDateString())->first()){
                        $data[$i]['created'] = 1;
                    }else{
                        $data[$i]['created'] = 0;
                    }
                }else if($docType == "TD"){
                    if(AppointmentSchedule::where('appmntType', 'VTD')->where('appmntDate', $date->toDateString())->first()){
                        $data[$i]['created'] = 1;
                    }else{
                        $data[$i]['created'] = 0;
                    }
                }
            }else{
                if($docType == "ED"){
                    if(AppointmentSchedule::where('appmntType', 'CED')->where('appmntDate', $date->toDateString())->where('appmntClinicid',  $request->appointment_type)->first()){
                        $data[$i]['created'] = 1;
                    }else{
                        $data[$i]['created'] = 0;
                    }
                }else if($docType == "TD"){
                    if(AppointmentSchedule::where('appmntType', 'CTD')->where('appmntDate', $date->toDateString())->where('appmntClinicid',  $request->appointment_type)->first()){
                        $data[$i]['created'] = 1;
                    }else{
                        $data[$i]['created'] = 0;
                    }
                }
                // return $request;
            }
        }
        $clinics = Clinic::all();
        return view('admin.appointment.index')
            ->with('clinics', $clinics)
            ->with('data', $data)
            ->with('show', 1)
            ->with('docType', $docType)
            ->with('appointmentType', $appmntType)
            ->with('start_date', $request->start_date)
            ->with('end_date', $request->end_date);
        // return $data;
    }

    // public function getLocation(){
    //     $loc = Clinic::all()->pluck('id', 'clinicName');
    //     return $loc;
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $services = Service::all();
    //     return view('admin.appointment.appointment')->with('services', $services);
    // }
    // public function create_video(){
    //     return view('admin.appointment.appointment_video');
    // }

    // public function create_clinic(){
    //     $clinics = Clinic::all();
    //     return view('admin.appointment.appointment_clinic')->with('clinics', $clinics);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $start_date, $end_date)
    {
        DB::beginTransaction();
        try{
            if($request->submit_type == "new"){
                if($request->appointmentType == "VED"){
                    $flagCount = 0;
                    if($request->docType == "TD")
                        $appmntType = "VTD";
                    else if($request->docType == "ED")
                        $appmntType = "VED";
                    for($i=0;$i<28;$i++){
                        if(!AppointmentSchedule::where('appmntDate', Carbon::parse($request->date)->toDateString())->where('appmntType', $appmntType)->where('appmntSlot', $request->time[$i])->first()){
                            $app = new AppointmentSchedule;
                            $app->appmntType = $appmntType;
                            $app->appmntDate = Carbon::parse($request->date)->toDateString();
                            $app->appmntSlot = $request->time[$i];
                            $app->appmntSlotMaxCount = $request->freecount[$i];
                            $app->appmntSlotFreeCount = $request->freecount[$i]-$request->booked[$i];
                            // if(){
                                if($request->time[$i] == $request->flag[$flagCount]){
                                    $app->appmntFlag = 1;
                                    if($flagCount < count($request->flag)-1){
                                        $flagCount++;
                                        // echo $flagCount.' '.count($request->flag);
                                    }
                                }else{
                                    $app->appmntFlag = 0;
                                }
                            // }
                            $app->save();
                        }else{
                            return redirect()->back()->with('error', 'Appointment already created!');
                        }
                    }
                }else{
                    $flagCount = 0;
                    if($request->docType == "TD")
                            $appmntType = "CTD";
                        else if($request->docType == "ED")
                            $appmntType = "CED";
                    for($i=0;$i<12;$i++){
                        $app = new AppointmentSchedule;
                        $app->appmntType = $appmntType;
                        $app->appmntClinicid = $request->appointmentType;
                        $app->appmntDate = Carbon::parse($request->date)->toDateString();
                        $app->appmntSlot = $request->time[$i];
                        $app->appmntSlotMaxCount = $request->freecount[$i];
                        $app->appmntSlotFreeCount = $request->freecount[$i]-$request->booked[$i];
                        if($request->time[$i] == $request->flag[$flagCount]){
                            $app->appmntFlag = 1;
                            if($flagCount < count($request->flag)-1){
                                $flagCount++;
                            }
                        }else{
                            $app->appmntFlag = 0;
                        }
                        $app->save();
                    }
                }
            }else if($request->submit_type == "old"){
                if($request->appointmentType == "VED"){
                    $flagCount = 0;
                    if($request->docType == "TD")
                        $appmntType = "VTD";
                    else if($request->docType == "ED")
                        $appmntType = "VED";
                        // return $request;
                    for($i=0;$i<28;$i++){
                        $app = AppointmentSchedule::where('appmntDate', Carbon::parse($request->date)->toDateString())->where('appmntType', $appmntType)->where('appmntSlot', $request->time[$i])->first();
                        if($app){
                            // echo $reques;
                            if($request->time[$i] == $request->flag[$flagCount]){
                                $app->appmntFlag = 1;
                                if($flagCount < count($request->flag)-1){
                                    $flagCount++;
                                }
                            }else{
                                $app->appmntFlag = 0;
                            }
                            $app->update();
                        }else{
                            return redirect()->back()->withInput()->with('error', 'Something went wrong!');
                        }
                    }
                }else{
                    $flagCount = 0;
                    if($request->docType == "TD")
                            $appmntType = "CTD";
                        else if($request->docType == "ED")
                            $appmntType = "CED";
                    for($i=0;$i<12;$i++){
                        $app = AppointmentSchedule::where('appmntDate', Carbon::parse($request->date)->toDateString())->where('appmntType', $appmntType)->where('appmntSlot', $request->time[$i])->where('appmntClinicid', $request->appointmentType)->first();
                        if($request->time[$i] == $request->flag[$flagCount]){
                            $app->appmntFlag = 1;
                            if($flagCount < count($request->flag)-1){
                                $flagCount++;
                            }
                        }else{
                            $app->appmntFlag = 0;
                        }
                        $app->update();
                    }
                }
            }else{
                return redirect()->back()->with('error', 'Something went wrong!');
            }

        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        $clinics = Clinic::all();
        if($request->submit_type == "old")
            $message = 'Appointment for '.$request->date.' added successfully';
        else if($request->submit_type == "new")
            $message = 'Appointment for '.$request->date.' updated successfully';
        return redirect('/admin/appointment')
            ->with('clinics', $clinics)
            ->with('show', 1)
            ->with('docType', $request->docType)
            ->with('appointmentType', $request->appointmentType)
            ->with('start_date', $start_date)
            ->with('end_date', $end_date)
            ->with('show', 0)
            ->with('success', $message);

        // return count($request->flag);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $appmntType, $start_date, $end_date)
    {
        $appointments = AppointmentSchedule::where('appmntDate', Carbon::parse($date)->toDateString())->where('appmntType', $appmntType)->get();
        if($appmntType == "VTD"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', 'VED')
                    ->with('docType', 'TD')
                    ->with('date', $date)
                    ->with('start_date', $start_date)
                    ->with('end_date', $end_date);
        }else if($appmntType == "VED"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', 'VED')
                    ->with('docType', 'ED')
                    ->with('date', $date)
                    ->with('start_date', $start_date)
                    ->with('end_date', $end_date);
        }
        
    }

    public function show_clinic($date, $appmntType, $clinic_id, $start_date, $end_date){
        $appointments = AppointmentSchedule::where('appmntDate', Carbon::parse($date)->toDateString())->where('appmntType', $appmntType)->where('appmntClinicid',  $clinic_id)->get();
        if($appmntType == "CTD"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', $clinic_id)
                    ->with('docType', 'TD')
                    ->with('date', $date)
                    ->with('start_date', $start_date)
                    ->with('end_date', $end_date);
        }else if($appmntType == "CED"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', $clinic_id)
                    ->with('docType', 'ED')
                    ->with('date', $date)
                    ->with('start_date', $start_date)
                    ->with('end_date', $end_date);
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
        if($request){
            $app = AppointmentSchedule::find($id);
            if($request->appmntSlotMaxCount != $app->appmntSlotMaxCount){
                if($request->appmntSlotMaxCount >= ($app->appmntSlotMaxCount-$app->appmntSlotFreeCount)){
                    $booked = $app->appmntSlotMaxCount - $app->appmntSlotFreeCount;
                    $app->appmntSlotMaxCount = $request->appmntSlotMaxCount;
                    $app->update();
                    $app->appmntSlotFreeCount = $app->appmntSlotMaxCount-$booked;
                    $app->update();
                    return redirect('/admin/appointment')->with('success', 'Apoointment updated successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error', 'Enter a value greater than or equal to Appointment booked count.');
                }
            }else{
                return redirect()->back()->withInput()->with('error', 'Appointment max value entered already exists.');
            }
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $app = AppointmentSchedule::find($id);
        $app->delete();
        return redirect('/admin/appointment')->with('success', 'Appointment deleted successfully!');
    }
}
