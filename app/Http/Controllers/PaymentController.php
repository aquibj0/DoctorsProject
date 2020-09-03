<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Redirect,Response;
use App\ServiceRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Tzsk\Sms\Facade\Sms;
use App\Jobs\SendEmail;
use App\AppointmentSchedule;


class PaymentController extends Controller
{ 
    private $razorpayId = "rzp_test_PgfHGuxQeXGP14";
    private $razorpayKey = "CyDWTmtUwE5PaI78yxrRpefq";

    public $data;

    public function paymentInitiate($data){

        // $serviceRequest = ServiceRequest::where('srId', $srvdID )->first();
        $api = new Api($this->razorpayId, $this->razorpayKey);

        // In razorpay you have to convert rupees into paise we multiply by 100
        // Currency will be INR 
        // Creating order
            $this->data = $data;
            $order = $api->order->create(array(
                'receipt' => $data['srvdID'],
                'amount' => $data['amount'] * 100,
                'currency' => 'INR'
                )
            );

            $response = [
                'orderId' => $order['id'],
                'razorpayId' => $this->razorpayId,
                'amount' => $data['amount'] * 100,
                'name' => $data['name'],
                'currency' => 'INR',
                'email' =>  $data['email'],
                'contactNumber' =>  $data['contactNumber'],
                'address' => 'Testing address',
                'description' => 'Testing description',
            ];        
            return view('ask-doctor.booking', compact('data', 'response'));
    }


   
    public function Complete($id, $srvdID, Request $request)
    {
        // return $request;
        // return array($id, $srvdID, $request);
        $user = Auth::user('id', $id)->first();
        $serviceRequest = ServiceRequest::where('srId', $srvdID )->first();
        // Now verify the signature is correct . We create the private function for verify the signature
        
        if(!isset($request->razorpay_signature)){
            return redirect('/service-request/'.$user->id.'/'.$serviceRequest->srId)->with('error', 'Payment Failed, please try again.');
        }

        $signatureStatus = $this->SignatureVerify(
            $request->all()['razorpay_signature'],
            $request->all()['razorpay_payment_id'],
            $request->all()['razorpay_order_id']
        );

        // If Signature status is true We will save the payment response in our database
        if($signatureStatus == true){
            $payment = new Payment;
            $payment->user_id = Auth::user()->id;
            $payment->service_req_id = $serviceRequest->id;
            $payment->order_id = $request['razorpay_order_id'];
            $payment->payment_transaction_id = $request['razorpay_payment_id'];
            $payment->signature = $request['razorpay_signature'];
            $payment->payment_amount = $serviceRequest->service->srvcPrice;
            $payment->save();

            if($payment->save()){
                $serviceReq = ServiceRequest::where('id', $serviceRequest->id)->first();
                $serviceReq->paymentStatus = true;
                $serviceReq->srStatus = "ACTIVE";
                $serviceReq->update();

                if($serviceReq->askQuestion){

                    Sms::send("We have received your Ask A Doctor request and payment of Rs. ".$serviceReq->payment->payment_amount ." for the same. Please upload documents. Doctor will respond in 24 hrs.")->to('91'.$user->userMobileNo)->dispatch();
                    SendEmail::dispatch($serviceReq->patient, $serviceReq, $serviceReq->askQuestion, $payment, $user, 1);
                }
                elseif($serviceReq->videoCall){
                    $app = AppointmentSchedule::where('id', $serviceReq->srAppmntId)->first();
                    $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                    $app->update();
                    Sms::send("We have received your Ask A Doctor request and payment of Rs. ".$serviceReq->payment->payment_amount ." for the same. Please upload documents. Doctor will respond in 24 hrs.")->to('91'.$user->userMobileNo)->dispatch();

                    SendEmail::dispatch($serviceReq->patient, $serviceReq, $serviceReq->videoCall, $payment, $user, 1);
                }
                elseif($serviceReq->clinicAppointment){
                    $app = AppointmentSchedule::where('id', $serviceReq->srAppmntId)->first();
                    $app->appmntSlotFreeCount = $app->appmntSlotFreeCount-1;
                    $app->update();
                    Sms::send("We have received your Ask A Doctor request and payment of Rs. ".$serviceReq->payment->payment_amount ." for the same. Please upload documents. Doctor will respond in 24 hrs.")->to('91'.$user->userMobileNo)->dispatch();

                    SendEmail::dispatch($serviceReq->patient, $serviceReq, $serviceReq->clinicAppointment, $payment, $user, 1);
                }

                return redirect()->route('servicereq-details', [$id, $serviceReq->srId])->with('success', 'Thank you for the order');
            }
        }
        else{
            
            // $serviceReq = ServiceRequest::where('srId', '=',$serviceRequest->srId )->first();
            // $serviceReq->paymentStatus = false;
            // $serviceReq->delete();

            // return redirect()->back()->with('success', 'Thank you for the order');
            // return redirect()->route('servicereq-details', [$id, $serviceRequest->srId])->with('error', 'Payment Failed, Please try again Later.');
            return redirect('/service-request/'.$user->id.'/'.$serviceRequest->srId)->with('error', 'Payment Failed, please try again.');
            // DB::rollback();
        }
    }

    // In this function we return boolean if signature is correct
    private function SignatureVerify($_signature=0,$_paymentId,$_orderId)
    {
        try
        {
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e)
        {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

}
