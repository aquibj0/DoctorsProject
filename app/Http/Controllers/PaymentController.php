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


class PaymentController extends Controller
{ 
    private $razorpayId = "rzp_test_Wq2JlvHGrZMLYz";
    private $razorpayKey = "nuKhC4fnkUXZW8AzrroZ1gxs";

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
        $user = Auth::user('id', $id)->first();
        $serviceRequest = ServiceRequest::where('srId', $srvdID )->first();
        // Now verify the signature is correct . We create the private function for verify the signature
        
        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );

        // If Signature status is true We will save the payment response in our database
        if($signatureStatus == true){
            $payment = new Payment;
            $payment->user_id = Auth::user()->id;
            $payment->service_req_id = $request['service_req_id'];
            $payment->order_id = $request['rzp_orderid'];
            $payment->payment_transaction_id = $request['rzp_paymentid'];
            $payment->signature = $request['rzp_signature'];
            $payment->payment_amount = $request['amount'];
            $payment->save();

            if($payment->save()){
                $serviceReq = ServiceRequest::where('id', $request->service_req_id)->first();
                $serviceReq->paymentStatus = true;
                $serviceReq->update();
                return redirect()->route('servicereq-details', [$id, $this->data['srvdID']])->with('success', 'Thank you for the order');
            }
        }
        else{
            
            $serviceReq = ServiceRequest::where('srId', '=',$serviceRequest->srId )->first();
            // $serviceReq->paymentStatus = false;
            $serviceReq->delete();

            // return redirect()->back()->with('success', 'Thank you for the order');
            return redirect()->route('servicereq-details', [$id, $serviceRequest->srId])->with('error', 'Payment Failed, Please try again Later.');
            // DB::rollback();
        }
    }

    // In this function we return boolean if signature is correct
    private function SignatureVerify($_signature,$_paymentId,$_orderId)
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
