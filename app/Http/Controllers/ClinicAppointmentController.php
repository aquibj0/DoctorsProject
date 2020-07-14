<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Carbon\Carbon;
use App\AppointmentSchedule;
use App\ServiceRequest;
use App\VideoCall;
use App\Service;
use App\Clinic;
use App\ClinicAppointment;
use Auth;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Validator;

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
        $location = Clinic::all();
        if($patient)
            return view('clinic-appointment.index')->with('patient', $patient)->with('location', $location);
        else
            return view('clinic-appointment.index')->with('patient', null)->with('location', $location);
    }


    public function getLocSLots($date, $id){
        $res = AppointmentSchedule::where('appmntDate', $date)
                                    ->where('appmntClinicid', $id)
                                    ->where('appmntSlotFreeCount', '>', 0)
                                    ->get()->pluck('id', 'appmntSlot');
        return $res;
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
        if($request->patient_id){
            $validator = Validator::make($request->all(), [
                // 'patient_id' => ['required', 'string', 'max:40'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentLoc' => ['required'],
                'slot' => ['required']
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if(!$validator->fails()){
                $patient = Patient::find($request->patient_id);
                if($patient){
                    $app = AppointmentSchedule::find($request->slot);
                    $srvcReq = new ServiceRequest;
                    $srvcReq->service_id = Service::where('srvcShortName', 'CLI')->first()->id;
                    $srvcReq->patient_id = $patient->id;
                    $srvcReq->user_id = Auth::user()->id;
                    $srvcReq->srRecievedDateTime = Carbon::now();
                    $srvcReq->srDueDateTime = $request->date;
                    $srvcReq->srDepartment = $request->department;
                    $srvcReq->srStatus = 'New'; 
                    $srvcReq->srAppmntId = $app->id;
                    $srvcReq->srConfirmationSentByAdmin = 'N';
                    $srvcReq->srMailSmsSent = Carbon::now();
                    $srvcReq->srDocumentUploadedFlag = 'N';
                    $srvcReq->srStatus = "NEW";
                    $srvcReq->save();
                    $srvcReq->srId = "SR".str_pad($srvcReq->id, 10, "0", STR_PAD_LEFT)."CLI";
                    $srvcReq->update();
                    // $srvdID = $srvcReq->srId ;
                    if($srvcReq->save()){
                        $clinicAppointment = new ClinicAppointment;
                        $clinicAppointment->clinic_id = $request->appointmentLoc;
                        $clinicAppointment->service_request_id = $srvcReq->id;
                        $clinicAppointment->save();
                        if($clinicAppointment->save()){
                            $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                            $app->update();
                            SendEmail::dispatch($patient, $srvcReq, $clinicAppointment, Auth::user(), 1)->delay(now()->addMinutes(1)); 
                            return redirect()->route('confirm-service-request', $srvcReq->srId);
                        }else{
                            $vc->delete();
                            return redirect()->back()->with('error', 'Something went wrong')->withInputs();
                        }
                    }else{
                        $srvcReq->delete();
                        return redirect()->back()->with('error', 'Something went wrong')->withInputs();
                    }
                }else{
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'firstName' => ['required', 'string', 'max:35'],
                'lastName' => ['required', 'string', 'max:35'],
                'gender' => ['required', 'string'],
                'age' => ['required', 'numeric', 'min:10', 'max:90', 'digits:2'],
                'patient_background' => ['required', 'string', 'max:1024'],
                'mobileCC' => ['required'],
                'patMobileNo' => ['required', 'digits:10', 'unique:patient'],
                'patEmail' => ['required', 'string', 'unique:patient'],
                'addressLine1' => ['required', 'string', 'max:64'],
                'addressLine2' => ['string', 'max:64'],
                'city' => ['required', 'string', 'max:35'],
                'district' => ['required', 'string', 'max:35'],
                'state' => ['required', 'string', 'max:35'],
                'country' => ['required', 'string', 'max:35'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentLoc' => ['required'],
                'slot' => ['required']
            ]);
            if(!$validator->fails()){
                $patient = new Patient;
                $patient->patId = str_random(15);
                $patient->user_id = Auth::user()->id;
                $patient->patFirstName = $request['firstName'];
                $patient->patLastName = $request['lastName'];
                $patient->patGender = $request['gender'];
                $patient->patAge = $request['age'];
                $patient->patBackground = $request['patient_background'];
                if(!empty($request->email)){
                    $patient->patEmail = $request['patEmail'];
                }
                $patient->patMobileCC = $request['mobileCC'];
                $patient->patMobileNo = $request['patMobileNo']; 
                $patient->patAddrLine1 = $request['addressLine1'];
                $patient->patAddrLine2 = $request['addressLine2'];
                $patient->patCity = $request['city'];
                $patient->patDistrict = $request['district'];
                $patient->patState = $request['state'];
                $patient->patCountry = $request['country'];
                $patient->save();
                $patient->patId = Auth::user()->userId."-".$patient->id;
                $patient->update();

                if($patient){
                    $app = AppointmentSchedule::find($request->slot);
                    $srvcReq = new ServiceRequest;
                    $srvcReq->service_id = Service::where('srvcShortName', $request->appointmentType)->first()->id;
                    $srvcReq->patient_id = $patient->id;
                    $srvcReq->user_id = Auth::user()->id;
                    $srvcReq->srRecievedDateTime = Carbon::now();
                    $srvcReq->srDueDateTime = $request->date;
                    $srvcReq->srDepartment = $request['department'];
                    $srvcReq->srStatus = 'New'; 
                    $srvcReq->srAppmntId = $app->id;
                    $srvcReq->srConfirmationSentByAdmin = 'N';
                    $srvcReq->srMailSmsSent = Carbon::now();
                    $srvcReq->srDocumentUploadedFlag = 'N';
                    $srvcReq->srStatus = "NEW";
                    $srvcReq->save();
                    $srvcReq->srId = "SR".str_pad($srvcReq->id, 10, "0", STR_PAD_LEFT).$request->appointmentType;
                    $srvcReq->update();
                    // $srvdID = $srvcReq->srId ;
                    if($srvcReq->save()){
                        $clinicAppointment = new ClinicAppointment;
                        $clinicAppointment->clinic_id = $request->appointmentLoc;
                        $clinicAppointment->service_request_id = $srvcReq->id;
                        $clinicAppointment->save();
                        if($clinicAppointment->save()){
                            $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                            $app->update();
                            SendEmail::dispatch($patient, $srvcReq, $clinicAppointment, Auth::user(), 1)->delay(now()->addMinutes(1)); 
                            return redirect()->route('confirm-service-request', $srvcReq->srId);
                        }else{
                            $vc->delete();
                            return redirect()->back()->with('error', 'Something went wrong')->withInputs();
                        }
                    }else{
                        $srvcReq->delete();
                        return redirect()->back()->with('error', 'Something went wrong')->withInputs();
                    }
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }
            // return $request;
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
