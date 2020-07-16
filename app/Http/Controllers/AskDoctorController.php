<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\AskAQuestion;
use App\Patient;
use App\ServiceRequest;
use App\Department;
use Auth;
use Mail;
use App\Mail\AAQEmail;
use App\Service;
use App\Jobs\SendEmail;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
// use Carbon\Carbon;

class AskDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $patient = Patient::find($id);
        $depts = Department::all();
        if(!empty($patient)){
            return view('ask-doctor.index')->with('patient', $patient)->with('depts', $depts);
        }else{
            return view('ask-doctor.index')->with('patient', null)->with('depts', $depts);
        }
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

        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:40'],
            'lastName' => ['required', 'string', 'max:40'],
            'gender' => ['required'],
            'age' => ['required'],
            'background' => ['required'],
            'email' => ['string', 'email', 'max:100'],
            'mobileCC' => ['required'],
            'mobileNo' => ['required', 'numeric',  'digits:10', 'unique:users', 'regex:/(01)[0-9]{9}/'],
            'addrLine1' => ['required', 'string', 'max:100'],
            'addrLine2' => [ 'string', 'max:100'],
            'city' => ['required'],
            'district' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
        ]);

        if($request){
            $validator = Validator::make($request->all(), [
                'firstName' => ['string', 'max:35'],
                'lastName' => ['string', 'max:35'],
                'gender' => ['string', 'min:4', 'max:6'],
                'age' => ['numeric', 'min:10', 'max:90'],
                'patient_background' => ['string', 'max:1024'],
                'patEmail' => ['email', 'max:255', 'unique:patient'],
                'patMobileNo' => ['numeric', 'digits:10', 'unique:patient'],
                'addressLine1' => ['string', 'max:64'],
                'addressLine2' => ['string', 'max:64'],
                'city' => ['string', 'max:35'],
                'district' => ['string', 'max:35'],
                'state' => ['string', 'max:35'],
                'country' => ['string', 'max:35'],
                'department' => ['string'],
                'patient_question' => ['string', 'max:1024']
            ]);
            if(!$validator->fails()){
                if($request['patient_id']){
                    $patient = Patient::find($request['patient_id']);
                }else{
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
                    $patient->patEmail = $request['patEmail']; 
                    $patient->patAddrLine1 = $request['addressLine1'];
                    $patient->patAddrLine2 = $request['addressLine2'];
                    $patient->patCity = $request['city'];
                    $patient->patDistrict = $request['district'];
                    $patient->patState = $request['state'];
                    $patient->patCountry = $request['country'];
                    $patient->save();
                    $patient->patId = Auth::user()->userId."-".$patient->id;
                    $patient->update();
                }

                if($patient->save()){
                    $srvcReq = new ServiceRequest;
                    $srvcReq->service_id = Service::where('srvcShortName', 'AAQ')->first()->id;
                    $srvcReq->patient_id = $patient->id;
                    $srvcReq->user_id = Auth::user()->id;
                    $srvcReq->srRecievedDateTime = Carbon::now();
                    $srvcReq->srDueDateTime = Carbon::now()->addHours(24);
                    $srvcReq->srDepartment = $request['department'];
                    $srvcReq->srStatus = $request['srStatus'];
                    $srvcReq->srConfirmationSentByAdmin = 'N';
                    $srvcReq->srMailSmsSent = Carbon::now();
                    $srvcReq->srDocumentUploadedFlag = 'N';
                    $srvcReq->srStatus = "NEW";
                    $srvcReq->save();
                    $srvcReq->srId = "SR".$srvcReq->id."AAQ";
                    $srvcReq->update();
                    


                    $srvdID = $srvcReq->srId ;


                    if($srvcReq->save()){
                        $asaq = new AskAQuestion;
                        $asaq->service_req_id = $srvcReq->id;
                        $asaq->aaqPatientBackground = $request['patient_background'];
                        $asaq->aaqQuestionText = $request['patient_question'];
                        $asaq->aaqDocResponseUploaded = 'N';
                        $asaq->save();
                        
                        //1 is the status for sending confirmation mail
                        //
                        SendEmail::dispatch($patient, $srvcReq, $asaq, null, 1)->delay(now()->addMinutes(1)); 
                        // if($patient->patEmail){
                        //     Mail::to(Auth::user()->userEmail)
                        //         ->cc($patient->patEmail)
                        //         ->send(new AAQEmail($patient, $srvcReq ,$asaq));
                        // }else{
                        //     Mail::to(Auth::user()->userEmail)
                        //         ->send(new AAQEmail($patient, $srvcReq ,$asaq));
                        // }
                        // return view('/ask-doctor.thank-you');
                        return redirect()->route('confirm-service-request', $srvdID);
                        // ->with('success', 'Your Booking is done, Please pay to confirm.');
                    }
                }
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }else{
            return redirect()->back()->withInputs()->with('error', 'Something went wrong!');
        }
    }



    public function serviceBooking(Request $request, $srvdID){

        $serviceRequest = ServiceRequest::where('srId', $srvdID )->first(); 
        // Let's see the documentation for creating the order
 
        // Generate random receipt id
        $receiptId = Str::random(20);

        $api = new Api($this->razorpayId, $this->razorpayKey);

        // In razorpay you have to convert rupees into paise we multiply by 100
        // Currency will be INR
        // Creating order
        $order = $api->order->create(array(
            'receipt' => $srvdID,
            'amount' => $serviceRequest->service->srvcPrice * 100,
            'currency' => 'INR'
            )
        );

        // Let's return the response 

        // Let's create the razorpay payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $this->razorpayId,
            'amount' => $serviceRequest->service->srvcPrice * 100,
            'name' => $serviceRequest->patient->userFirstName,
            'currency' => 'INR',
            'email' =>  $serviceRequest->patient->userEmail,
            'contactNumber' =>  $serviceRequest->patient->userMobileNo,
            'address' => $serviceRequest->patient->userLastName,
            'description' => 'Testing description',
        ];

        // Let's checkout payment page is it working
        
        return view('ask-doctor.booking', compact('serviceRequest', 'response'));
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


    public function updateServiceStatus(Request $request, $id){
        $serviceReq = ServiceRequest::find($id);
        if($request){
            $serviceReq->srStatus = $request['srStatus'];
            $serviceReq->update();
            return redirect()->back()->with('success', 'Cancellation Requested');
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
