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
            }
        }
        $clinics = Clinic::all();
        return view('admin.appointment.index')
            ->with('clinics', $clinics)
            ->with('data', $data)
            ->with('show', 1)->with('docType', $docType)->with('appointmentType', $appmntType);
        // return $data;
    }

    public function getLocation(){
        $loc = Clinic::all()->pluck('id', 'clinicName');
        return $loc;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.appointment.appointment')->with('services', $services);
    }
    public function create_video(){
        return view('admin.appointment.appointment_video');
    }

    public function create_clinic(){
        $clinics = Clinic::all();
        return view('admin.appointment.appointment_clinic')->with('clinics', $clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            if($request->docType == "CTD" || $request->docTYpe == "CED"){
                for($i = 0; $i<12;$i++){
                    $app = AppointmentSchedule::where('appmntType', $request->docType)
                                                ->where('appmntDate', $request->date)
                                                ->where('appmntSlot', $request->time[$i])
                                                ->where('appmntClinicid', $request->clinic_id)
                                                ->first();
                    if(!$app){
                        $app = new AppointmentSchedule;
                        $app->appmntType = $request->docType;
                        $app->appmntDate = $request->date;
                        $app->appmntSlot = $request->time[$i];
                        $app->appmntSlotMaxCount = $request->freecount[$i];
                        $app->appmntSlotFreeCount = $request->freecount[$i];
                        if($request->docType == "CTD" || $request->docType == "CED"){
                            $app->appmntClinicid = $request->clinic_id;
                        }
                        $app->save();
                    }else{
                        return redirect()->back()->with('error', 'Appointment for '.$request->time[$i].' on '.$request->date.' of '.$request->docType.' has been created earlier.');
                    }
                }
                // return $request;
            }else{
                for($i = 0; $i<24;$i++){
                    $app = AppointmentSchedule::where('appmntType', $request->docType)
                                                ->where('appmntDate', $request->date)
                                                ->where('appmntSlot', $request->time[$i])
                                                ->first();
                    if(!$app){
                        $app = new AppointmentSchedule;
                        $app->appmntType = $request->docType;
                        $app->appmntDate = $request->date;
                        $app->appmntSlot = $request->time[$i];
                        $app->appmntSlotMaxCount = $request->freecount[$i];
                        $app->appmntSlotFreeCount = $request->freecount[$i];
                        $app->save();
                    }else{
                        return redirect()->back()->with('error', 'Appointment for '.$request->time[$i].' on '.$request->date.' of '.$request->docType.' has been created earlier.');
                    }
                }  
            }
        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect('/admin/appointment')->with('success', 'Appointment for '.$request->date.' added successfully');
        // return $request;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $appmntType)
    {
        $appointments = AppointmentSchedule::where('appmntDate', Carbon::parse($date)->toDateString())->where('appmntType', $appmntType)->get();
        if($appmntType == "VTD"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', 'VED')
                    ->with('docType', 'TD')
                    ->with('date', $date);
        }else if($appmnetType == "VED"){
            return view('admin.appointment.appointment')
                    ->with('appointments', $appointments)
                    ->with('appointmentType', 'VED')
                    ->with('docType', 'ED')
                    ->with('date', $date);
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
