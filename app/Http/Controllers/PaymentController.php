<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Redirect,Response;


class PaymentController extends Controller
{ 
    private $razorpayId = "rzp_test_Wq2JlvHGrZMLYz";
    private $razorpayKey = "nuKhC4fnkUXZW8AzrroZ1gxs";



    public function Initiate(Request $request)
    {
        // Generate random receipt id
        $receiptId = Str::random(20);
        
        // Create an object of razorpay
        $api = new Api($this->razorpayId, $this->razorpayKey);

        // In razorpay you have to convert rupees into paise we multiply by 100
        // Currency will be INR
        // Creating order 
        $order = $api->order->create(array(
            'receipt' => $receiptId,
            'amount' => $request->all()['payment_amount'] * 100,
            'currency' => 'INR'
            )
        );

        // Return response on payment page
        $response = [
            'payment_transaction_id' => $order['id'],
            'razorpayId' => $this->razorpayId,
            'payment_amount' => $request->all()['payment_amount'] * 100,
            
            'service_req_id' => $request->all()['service_req_id'],
            'user_id' => $request->all()['user_id'],

            'currency' => 'INR',
            'description' => 'Testing description',
        ];

        // Let's checkout payment page is it working
        return view('payment-page',compact('response'));
    }















    public function paysuccess(Request $request){
        $data = [
            'service_request_id' => $request->service_request_id,
            'user_id' => Auth::user()->id,
            'payment_transaction_id' => $request->payment_transaction_id,
            'payment_amount' => $request->payment_amount,
        ];


        $getId = Payment::insertGetId($data);  
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return Response()->json($arr);  
    }
}
