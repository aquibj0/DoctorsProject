<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Clinic;
use App\Service;
use App\AppointmentSchedule;
use Auth;
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
    public function index($docType=0, $appmntType=0, $start_date=0, $end_date=0)
    {
        // return array($docType, $appmntType, $start_date, $end_date);
        if(Auth::user()->category == "admin"){
            $clinics = Clinic::all();
            return view('admin.appointment.index')->with('clinics', $clinics)
                                                ->with('show', 0)
                                            ->with('docType', $docType)
                                            ->with('appointmentType', $appmntType)
                                            ->with('start_date', $start_date)
                                            ->with('end_date', $end_date)
                                            ->with('counter', 0);
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function check(Request $request){

        if(Auth::user()->category == "admin"){
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
                ->with('counter', 1)
                ->with('docType', $docType)
                ->with('appointmentType', $appmntType)
                ->with('start_date', $request->start_date)
                ->with('end_date', $request->end_date);
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
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
                    for($i=0;$i<40;$i++){
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
                    for($i=0;$i<20;$i++){
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
                    for($i=0;$i<40;$i++){
                        $app = AppointmentSchedule::where('appmntDate', Carbon::parse($request->date)->toDateString())->where('appmntType', $appmntType)->where('appmntSlot', $request->time[$i])->first();
                        if($app){
                            if($request->time[$i] == $request->flag[$flagCount]){
                                $booked = $app->appmntSlotMaxCount - $app->appmntSlotFreeCount;
                                $app->appmntSlotMaxCount = $request->freecount[$i];
                                if($request->freecount[$i] - $booked > 0){
                                    // echo $request->freecount[$i] - $booked, $app->appmntSlotMaxCount, $app->appmntSlotFreeCount;
                                    $app->appmntSlotFreeCount = $request->freecount[$i] - $booked;
                                }else{
                                    DB::rollback();
                                    return redirect()->back()->withInput()->with('error', 'Cannot update! As '.$app->appmntDate.' '.$app->appmntSlot.' is getting below booked count.');
                                }
                                $app->appmntFlag = 1;
                                // echo $app, $booked;
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
                    for($i=0;$i<20;$i++){
                        $app = AppointmentSchedule::where('appmntDate', Carbon::parse($request->date)->toDateString())->where('appmntType', $appmntType)->where('appmntSlot', $request->time[$i])->where('appmntClinicid', $request->appointmentType)->first();
                        if($request->time[$i] == $request->flag[$flagCount]){
                            $booked = $app->appmntSlotMaxCount - $app->appmntSlotFreeCount;
                            $app->appmntSlotMaxCount = $request->freecount[$i];
                            if($request->freecount[$i] - $booked > 0){
                                // echo $request->freecount[$i] - $booked, $app->appmntSlotMaxCount, $app->appmntSlotFreeCount;
                                $app->appmntSlotFreeCount = $request->freecount[$i] - $booked;
                            }else{
                                DB::rollback();
                                return redirect()->back()->withInput()->with('error', 'Cannot update! As '.$app->appmntDate.' '.$app->appmntSlot.' is getting below booked count.');
                            }
                            $app->appmntFlag = 1;
                            // echo $app;
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
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        DB::commit();
        $clinics = Clinic::all();
        if($request->submit_type == "new")
            $message = 'Appointment for '.$request->date.' added successfully';
        else if($request->submit_type == "old")
            $message = 'Appointment for '.$request->date.' updated successfully';

        return redirect('/admin/appointment/'.$request->docType.'/'.$request->appointmentType.'/'.$start_date.'/'.$end_date.'/index')->with('success', $message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $appmntType, $start_date, $end_date)
    {
        if(Auth::user()->category == "admin"){
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
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show_clinic($date, $appmntType, $clinic_id, $start_date, $end_date){
        
        if(Auth::user()->category == "admin"){
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
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
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

    public function down($date, $type, $clinic, $start, $end){
        // return array($date, $type, $clinic);
        // echo $date;
        // echo $type;
        // echo $clinic;
        if(Auth::user()->category == "admin"){
            $docType = " ";
            $appointmentType = " ";
            DB::beginTransaction();
            if($type == "VTD"){
                $docType = "TD";
                $appointmentType = "VED";
            }else if($type == "VED"){
                $docType = "ED";
                $appointmentType = "VED";
            }else if($type == "CTD"){
                $docType = "TD";
                $appointmentType = $clinic;
            }else if($type == "CED"){
                $docType = "ED";
                $appointmentType = $clinic;
            }
            // return array($date, $type, $clinic, $start, $end, $docType, $appointmentType);
            try{
                if($clinic == 0){
                    $app = AppointmentSchedule::where('appmntDate', Carbon::parse($date)->toDateString())
                                                ->where('appmntType', $type)->get();
                                                // return $app;
                }else{
                    $app = AppointmentSchedule::where('appmntDate', Carbon::parse($date)->toDateString())
                                                ->where('appmntType', $type)
                                                ->where('appmntClinicid', $clinic)->get();
                                                        // return $app;
                }
                if(isset($app)){
                    foreach($app as $item){
                        if($item->appmntSlotMaxCount - $item->appmntSlotFreeCount == 0){
                            $item->delete();
                        }else{
                            DB::rollback();
                            return redirect('/admin/appointment/'.$docType.'/'.$appointmentType.'/'.$start.'/'.$end.'/index')->with('error', 'Appointment exists for '.$date.' '.$item->appmntSlot.'!');
                        }
                    }
                }else{
                    DB::rollback();
                    return redirect('/admin/appointment/'.$docType.'/'.$appointmentType.'/'.$start.'/'.$end.'/index')->with('error', 'Appointment didn\'t exists for '.$date);
                }
            }catch (\Exception $e){
                DB::rollback();
                // return $e->getMessage();
                return redirect('/admin/appointment/'.$docType.'/'.$appointmentType.'/'.$start.'/'.$end.'/index')->with('error', 'Something Went wrong!');
            }
            DB::commit();
            return redirect('/admin/appointment/'.$docType.'/'.$appointmentType.'/'.$start.'/'.$end.'/index')->with('success', 'Appointment for '.$date.' has been deleted!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        // return $app;
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
