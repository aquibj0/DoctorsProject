<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceRequest;
use App\Service;
use App\Patient;
use App\AskAQuestion;
use App\User;
use App\Admin;
use App\VideoCall;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;
use App\Invoice;

class ServiceRequestController extends Controller
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

    public function query($query){
        if($query == "paid"){
            $result = ServiceRequest::where('paymentStatus', 1)->get();
            return $result;
        }
        if($query == "unpaid"){
            $result = ServiceRequest::whereNull('paymentStatus')->get();
            return $result;
        }
        if($query == "AAQ" || $query == "VED" || $query == "VTD" || $query == "CLI"){
            $service = Service::where('srvcShortName', $query)->first(); 
            $result = ServiceRequest::where('service_id', $service->id)->get();
            return $result;
        }
    }

    public function response($id, Request $request){
        DB::beginTransaction();
        try{
            $aaq = AskAQuestion::find($id);
            $aaq->aaqDocResponse = $request['response'];
            $aaq->update();

            $servcReq = ServiceRequest::find($aaq->service_req_id);
            $servcReq->srResponseDateTime = Carbon::now();
            $servcReq->srStatus = 'CLOSED';
            $servcReq->update();
            $invoice = new Invoice;
            $invoice->service_request_id = $servcReq->id;
            $invoice->invoice_date = Carbon::now()->toDateString();
            $invoice->patient_name = $servcReq->patient->patFirstName.' '.$servcReq->patient->patLasttName;
            $invoice->patient_address_line1 = $servcReq->patient->patAddrLine1;
            $invoice->patient_address_line2 = $servcReq->patient->patAddrLine2;
            $invoice->patient_city = $servcReq->patient->patCity;
            $invoice->patient_district = $servcReq->patient->patDistrict;
            $invoice->patient_country = $servcReq->patient->patCountry;
            $invoice->service_name = $servcReq->service->srvcName;
            $invoice->service_price = $servcReq->payment->payment_amount;
            $invoice->service_amount = $servcReq->payment->payment_amount;
            // $invoice->service_quantity = 1;
            $invoice->doctor_name = Admin::find($servcReq->srAssignedIntUserId)->firstName.' '.Admin::find($servcReq->srAssignedIntUserId)->firstName;
            $invoice->save();
            $invoice->invoice_number = Carbon::now()->year.str_pad($invoice->id, 5, 0, STR_PAD_LEFT);
            $invoice->update();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong! Please try agian later. ');
        }
        DB::commit();
        // $patient = $srvcReq->patient();
        $patient = Patient::find($servcReq->patient_id);

        $user = User::find($servcReq->user_id);
        
        //service request responded
        SendEmail::dispatch($patient, $servcReq, $aaq, $servcReq->payment, $user, 2)->delay(now()->addMinutes(1));
        // for service request closed
        SendEmail::dispatch($servcReq->patient, $servcReq, null, null, $servcReq->user, 5); 

        return redirect()->route('admin.dashboard')->with('success', 'Added Response to Service Request ID :'.$servcReq->srId.'!');
    }





      // Store doctor internal notes
    public function internalNotes($id, Request $request){
        $internalNotes = VideoCall::where('id', $id)->first();
        if($request){
            $internalNotes->vcDocInternalNotesText = $request['vcDocInternalNotesText'];
            $internalNotes->update();

            return redirect()->back()->with('success', 'Internal Notes Saved');
            // return $internalNotes;
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
        $srvcReq = ServiceRequest::find($id);
        if(!empty($srvcReq)){
            // $service = Service::find($srvcReq->service_id);
            $patient = Patient::find($srvcReq->patient_id);
            // return strpos($srvcReq->srId, "AAQ");
            // if(strpos($srvcReq->srId, "AAQ") == true){
            //     $asaq = AskAQuestion::find($srvcReq->servSpecificId);
            return view('admin.service-request-details')->with('srvcReq', $srvcReq)
                ->with('patient', $patient);
                // ->with('aaq', $asaq);
            // }
            // $asaq = AskAQuestion::find($srvcReq->)
        }
        else{
            return redirect('/admin/dashboard')->with('error', 'Service Request not found!');
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


    public function closeServiceRequest($id){
        // return $id;
        $servcReq = ServiceRequest::find($id);
        if(isset($servcReq)){
            if($servcReq->srStatus == "CLOSED")
                return redirect()->back()->with('error', 'Service Request '.$servcReq->srId.' has been closed already!');
            
            DB::beginTransaction();
            try{
                $servcReq->srStatus = "CLOSED";
                $servcReq->update();

                // id 	service_request_id 	invoice_number 	invoice_date
                // patient_name 	patient_address_line1 	patient_address_line2 	patient_city
                //patient_district 	patient_country 	service_name 	service_price 	
                //service_amount 	service_quantity 	doctor_name 	created_at 	updated_at 
                $invoice = new Invoice;
                $invoice->service_request_id = $servcReq->id;
                $invoice->invoice_date = Carbon::now()->toDateString();
                $invoice->patient_name = $servcReq->patient->patFirstName.' '.$servcReq->patient->patLasttName;
                $invoice->patient_address_line1 = $servcReq->patient->patAddrLine1;
                $invoice->patient_address_line2 = $servcReq->patient->patAddrLine2;
                $invoice->patient_city = $servcReq->patient->patCity;
                $invoice->patient_district = $servcReq->patient->patDistrict;
                $invoice->patient_country = $servcReq->patient->patCountry;
                $invoice->service_name = $servcReq->service->srvcName;
                $invoice->service_price = $servcReq->payment->payment_amount;
                $invoice->service_amount = $servcReq->payment->payment_amount;
                // $invoice->service_quantity = 1;
                $invoice->doctor_name = Admin::find($servcReq->srAssignedIntUserId)->firstName.' '.Admin::find($servcReq->srAssignedIntUserId)->firstName;
                $invoice->save();
                $invoice->invoice_number = Carbon::now()->year.str_pad($invoice->id, 5, 0, STR_PAD_LEFT);
                $invoice->update();

            } catch(\Exception $e){
                DB::rollback();
                return redirect()->back()->with('error', 'Something went wrong! Please try agian later. ');
            }
            DB::commit();
            
            SendEmail::dispatch($servcReq->patient, $servcReq, null, null, $servcReq->user, 5);
            return redirect()->back()->with('success', 'Service Request '.$servcReq->srId.' closed successfully.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong! Please try agian later.');
        }
    }
}
