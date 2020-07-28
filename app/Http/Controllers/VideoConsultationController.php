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
use App\Department;
use Auth;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Controllers\PaymentController;

class VideoConsultationController extends Controller
{
    public $payments;
    
    public function __construct(){
        $this->payments = new PaymentController;
    }
    /**
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $patient = Patient::find($id);
        // $slot = AppointmentSchedule::where('appmntSlotFreeCount','>', 0)->get();
        $depts = Department::all();
        if($patient)
            return view('VideoConsultation.index')->with('patient', $patient)->with('depts', $depts);
        else
            return view('VideoConsultation.index')->with('patient', null)->with('depts', $depts);
    }

    public function getSlots($date, $appType){
        // if(request()->ajax()){
            $slot = AppointmentSchedule::where('appmntDate',  $date)
                    ->where('appmntType', $appType)
                    ->where('appmntFlag', 1)
                    ->where('appmntSlotFreeCount', '>', 0)->pluck('id', 'appmntSlot');
            // return response()->json($slot);
            return $slot;
        // }
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
        $user = Auth::user();
        // DB::transaction(function(){
        if($request->patient_id){
            $validator = Validator::make($request->all(), [
                // 'patient_id' => ['required', 'string', 'max:40'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentType' => ['required', 'min:3', 'max:3'],
                'slot' => ['required']
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if(!$validator->fails()){
                // DB::beginTransaction();
                // try{
                    $patient = Patient::find($request->patient_id);
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
                            
                            $vc = new VideoCall;
                            $vc->service_req_id = $srvcReq->id;
                            $vc->vcCallScheduled = 'N';
                            $vc->vcDocPrescriptionUploaded = 'N';
                            // $vc->vcCallScheduledDtl = 'N';
                            $vc->save();

                            // Send Confirmation Message using textlocal
                            Sms::send("This is test message with Service RequestID ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();

                            if($vc->save()){
                                $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                                $app->update();
                                SendEmail::dispatch($patient, $srvcReq, $vc, Auth::user(), 1)->delay(now()->addMinutes(1)); 
                                
                               


                                $data = array();
                                $data['amount'] = Service::where('srvcShortName', $request->appointmentType)->first()->srvcPrice;
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
                        return redirect()->back()->with('error', 'Something went wrong!');
                    }
                // } catch(\Exception $e){
                //     DB::rollback();
                //     return redirect()->back()->withInput()->with('error', $e->getMessage());
                // }
                // DB::commit();
                return $res;
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }else{
            $validator = Validator::make($request->all(),[
                'firstName' => ['required', 'string', 'max:35'],
                'lastName' => ['required', 'string', 'max:35'],
                'gender' => ['required', 'string'],
                'age' => ['required', 'numeric', 'min:10', 'max:90', 'digits:2'],
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
                'appointmentType' => ['required', 'min:3', 'max:3'],
                'slot' => ['required']
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
                            
                            $vc = new VideoCall;
                            $vc->service_req_id = $srvcReq->id;
                            $vc->vcCallScheduled = 'N';
                            $vc->vcDocPrescriptionUploaded = 'N';
                            // $vc->vcCallScheduledDtl = 
                            $vc->save();


                            // Send Confirmation Message using textlocal
                            Sms::send("This is test message with Service RequestID ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();
                            
                            if($vc->save()){
                                $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                                $app->update();
                                SendEmail::dispatch($patient, $srvcReq, $vc, Auth::user(), 1)->delay(now()->addMinutes(1)); 

                                $data = array();
                                $data['amount'] = Service::where('srvcShortName', $request->appointmentType)->first()->srvcPrice;
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
                    return redirect()->back()->withInput()->with('error', $e->getMessage());
                }
                DB::commit();
                return $res;
            }
        // return $request;
        }
        // });
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
