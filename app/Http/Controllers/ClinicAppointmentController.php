<?php

namespace App\Http\Controllers;

use Tzsk\Sms\Facade\Sms;
use Illuminate\Http\Request;
use App\Patient;
use Carbon\Carbon;
use App\AppointmentSchedule;
use App\ServiceRequest;
use App\VideoCall;
use App\Service;
use App\Clinic;
use App\ClinicAppointment;
use App\Department;
use Auth;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaymentController;

class ClinicAppointmentController extends Controller
{
    public $payments;
    public function __construct(){
        $this->payments = new PaymentController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $patient = Patient::find($id);
        $depts = Department::all();
        $location = Clinic::all();
        if($patient)
            return view('clinic-appointment.index')->with('patient', $patient)->with('location', $location)->with('depts', $depts);
        else
            return view('clinic-appointment.index')->with('patient', null)->with('location', $location)->with('depts', $depts);
    }


    public function getLocSlots($date, $service, $id){
        $res = AppointmentSchedule::where('appmntDate', $date)
                                    ->where('appmntClinicid', $id)
                                    ->where('appmntType', $service)
                                    ->where('appmntFlag', 1)
                                    ->where('appmntSlotFreeCount', '>', 0)
                                    ->get()->pluck('id', 'appmntSlot');
        // return array($date, $service, $id);
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
        $user = Auth::user();

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
                    DB::beginTransaction();
                    try{
                    $app = AppointmentSchedule::find($request->slot);
                    $srvcReq = new ServiceRequest;
                    $srvcReq->service_id = Service::where('srvcShortName', $request['service'])->first()->id;
                    $srvcReq->patient_id = $patient->id;
                    $srvcReq->user_id = Auth::user()->id;
                    $srvcReq->srRecievedDateTime = Carbon::now();
                    $srvcReq->srDueDateTime = $app->appmntDate.' '.$app->appmntSlot;
                    $srvcReq->srDepartment = $request->department;
                    $srvcReq->srStatus = 'New'; 
                    $srvcReq->srAppmntId = $app->id;
                    $srvcReq->srConfirmationSentByAdmin = 'N';
                    $srvcReq->srMailSmsSent = Carbon::now();
                    $srvcReq->srDocumentUploadedFlag = 'N';
                    $srvcReq->srStatus = "NEW";
                    $srvcReq->save();
                    $srvcReq->srId = "SR".str_pad($srvcReq->id, 10, "0", STR_PAD_LEFT).$request['service'];
                    $srvcReq->update();
                    // $srvdID = $srvcReq->srId ;
                        if($srvcReq->save()){
                            $clinicAppointment = new ClinicAppointment;
                            $clinicAppointment->clinic_id = $request->appointmentLoc;
                            $clinicAppointment->service_request_id = $srvcReq->id;
                            $clinicAppointment->save();


                            // Send Confirmation Message using textlocal
                            // Sms::send("Thank you. Your Service Request has been created with SR-ID  ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();
                                

                            if($clinicAppointment->save()){
                                // $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                                // $app->update();
                                // SendEmail::dispatch($patient, $srvcReq, $clinicAppointment, Auth::user(), 3);/*->delay(now()->addMinutes(1)); */
                                
                            
                                
                                $data = array();
                                $data['amount'] = Service::where('srvcShortName', $request['service'])->first()->srvcPrice;
                                $data['check_amount'] = $data['amount'];
                                $data['srvdID'] = $srvcReq->srId;
                                $data['srId'] = $srvcReq->id;
                                $data['name'] = Auth::user()->userFirstName.' '.Auth::user()->userLastName;
                                $data['contactNumber'] = Auth::user()->userMobileNo;
                                $data['email'] = Auth::user()->userEmail;
                                
                                $res = $this->payments->paymentInitiate($data);
                                // return redirect()->route('confirm-service-request', $srvcReq->srId);
                            }else{
                                $srvcReq->delete();
                                return redirect()->back()->with('error', 'Something went wrong')->withInputs();
                            }
                        }
                    } catch(\Exception $e){
                        DB::rollback();
                        return redirect()->back()->withInput()->with('error', 'Something went wrong');
                    }
                    DB::commit();
                    return $res;
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
                'patMobileNo' => ['required', 'digits:10'],
                'patEmail' => ['required', 'string'],
                'addressLine1' => ['required', 'string', 'max:64'],
                'addressLine2' => ['nullable','string', 'max:64'],
                'city' => ['required', 'string', 'max:35'],
                'district' => ['nullable', 'string', 'max:35'],
                'state' => ['required', 'string', 'max:35'],
                'country' => ['required', 'string', 'max:35'],
                'pincode' => ['required', 'numeric', 'digits:6'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentLoc' => ['required'],
                'slot' => ['required'],
                'patPhotoFileNameLink' => ['nullable', 'max:2048', 'mimes:jpeg,jfif,jpg,png,pdf']
            ]);
            if(!$validator->fails()){
                DB::beginTransaction();
                try{
                    $patient = new Patient;
                    $patient->patId = str_random(15);
                    $patient->user_id = Auth::user()->id;
                    $patient->patFirstName = $request['firstName'];
                    $patient->patLastName = $request['lastName'];
                    $patient->patGender = $request['gender'];
                    $patient->patAge = $request['age'];
                    $patient->patBackground = $request['patient_background'];
                    $patient->patEmail = $request['patEmail'];
                    $patient->patMobileCC = $request['mobileCC'];
                    $patient->patMobileNo = $request['patMobileNo']; 
                    $patient->patAddrLine1 = $request['addressLine1'];
                    $patient->patAddrLine2 = $request['addressLine2'];
                    $patient->patCity = $request['city'];
                    $patient->patDistrict = $request['district'];
                    $patient->patState = $request['state'];
                    $patient->patCountry = $request['country'];
                    $patient->patPincode = $request['pincode'];

                    if($request->hasFile('patPhotoFileNameLink')){
                        //Get filename with extension
                        $fileNameWithExt = $request->file('patPhotoFileNameLink')->getCLientOriginalName();
                        // Get just filename
                        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                        // Get just ext
                        $extension = $request->file('patPhotoFileNameLink')->getClientOriginalExtension();
                        //File name to Store
                        $fileNameToStore = $filename.$extension;
                        //Upload File
                        $path = $request->file('patPhotoFileNameLink')->storeAs('public/patPhotoFileNameLink',$fileNameToStore);
                    }
                    else{
                        $fileNameToStore = 'nofile.img';
                    }
                    $patient->patPhotoFileNameLink = $fileNameToStore;
                    $patient->save();
                    $patient_no = count(Patient::where('user_id', Auth::user()->id)->get())+1;
                    $patient->patId = Auth::user()->userId."-".str_pad($patient_no, 2, "0", STR_PAD_LEFT);
                    $patient->update();

                    if($patient->save()){
                        $app = AppointmentSchedule::find($request->slot);
                        $srvcReq = new ServiceRequest;
                        $srvcReq->service_id = Service::where('srvcShortName', $request['service'])->first()->id;
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
                        $srvcReq->srId = "SR".str_pad($srvcReq->id, 10, "0", STR_PAD_LEFT)."CLI";
                        $srvcReq->update();
                        // $srvdID = $srvcReq->srId ;
                        if($srvcReq->save()){
                            $clinicAppointment = new ClinicAppointment;
                            $clinicAppointment->clinic_id = $request->appointmentLoc;
                            $clinicAppointment->service_request_id = $srvcReq->id;
                            $clinicAppointment->save();
                            // Send Confirmation Message using textlocal
                            // Sms::send("Thank you. Your Service Request has been created with SR-ID  ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();

                            if($clinicAppointment->save()){
                                // $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                                // $app->update();

                                // SendEmail::dispatch($patient, $srvcReq, $clinicAppointment, Auth::user(), 3)->delay(now()->addMinutes(1)); 
                                
                                $data = array();
                                $data['amount'] = Service::where('srvcShortName', $request['service'])->first()->srvcPrice;
                                $data['check_amount'] = $data['amount'];
                                $data['srvdID'] = $srvcReq->srId;
                                $data['srId'] = $srvcReq->id;
                                $data['name'] = Auth::user()->userFirstName.' '.Auth::user()->userLastName;
                                $data['contactNumber'] = Auth::user()->userMobileNo;
                                $data['email'] = Auth::user()->userEmail;
                                
                                $res = $this->payments->paymentInitiate($data);
                                // return redirect()->route('confirm-service-request', $srvcReq->srId);
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
                } catch(\Exception $e){
                    DB::rollback();
                    return redirect()->back()->withInput()->with('error', 'Something went wrong!');
                }
                DB::commit();
                return $res;
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
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
