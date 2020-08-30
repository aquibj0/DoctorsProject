@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')


{{-- <section class="booking-confirmed mt-4">
    <div class="container">

        
        <div class="card">
            <div class="card-body">
                @include('layouts.message')

                <h2 class="maroon"><b>Hi {{Auth::user()->userFirstName}} {{Auth::user()->userLastName}} your booking confirmed with us, please find the details below.</b></h2>
                <p><b>Booking ID</b> : <span>{{$serviceRequest->srId}}</span></p>         
                <p><b>Patient  Name</b> : <span>{{$serviceRequest->patient->patFirstName}} {{$serviceRequest->patient->patLastName}}</span></p>    
                <p><b>Patient Gender</b> : <span>{{$serviceRequest->patient->patGender}}</span></p>
                <p><b>Patient Age</b> : <span>{{$serviceRequest->patient->patAge}}</span></p>
                <p><b>Patient Background</b> : <span>{{$serviceRequest->patient->patBackground}}</span></p>
                <p><b>Service Amount</b> : <span>₹{{ $serviceRequest->service->srvcPrice}}</span></p>
                 

                
                
                <!-- I'l copy the form  -->
                <!-- This form is hidden -->
                <!-- Let's crate the controller function -->
              


            </div>
        </div>
    </div>
</section> --}}

@endsection
<form hidden method="POST" action="https://api.razorpay.com/v1/checkout/embedded">
    {{-- {{ csrf_field() }} --}}
    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
    <input type="hidden" name="key_id" value="{{$response['razorpayId']}}">
    <input type="hidden" name="order_id" value="{{$response['orderId']}}">
    <input type="hidden" name="amount" value="{{$response['amount']}}">
    <input type="hidden" name="name" value="HDFC VAS">
    <input type="hidden" name="description" value="Enter description">
    <input type="hidden" name="prefill[email]" value="{{$response['email']}}">
    <input type="hidden" name="prefill[contact]" value="{{$response['contactNumber']}}">
    <input type="hidden" name="callback_url" value="{{url('payment-complete/'.Auth::user()->id.'/'.$data['srvdID'])}}">
    <button id="rzp-button1" type="submit" hidden>Submit</button>
</form>

{{-- <button hidden>Pay</button>  --}}

{{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> --}}
<script>
var options = {
    // "callback_url": "/payment-initiate-request",   
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "{{$response['currency']}}",
    "name": "{{$response['name']}}",
    "description": "{{$response['description']}}",
    "image": "https://example.com/your_logo", // You can give your logo url
    "order_id": "{{$response['orderId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "redirect": "false",
    


    
    "handler": function (response){
        // After payment successfully made response will come here
        // Let's send this response to Controller for update the payment response
        // Create a form for send this data
        // Set the data in form
        document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
        document.getElementById('rzp_orderid').value = response.razorpay_order_id;
        document.getElementById('rzp_signature').value = response.razorpay_signature;

        // // Let's submit the form automatically
        document.getElementById('rzp-paymentresponse').click();
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "{{$response['contactNumber']}}"
    },
    "theme": {
        "color": "#F37254"
    }
};
// var rzp1 = new Razorpay(options); 
// <script>
window.onload = function(){
    document.getElementById('rzp-button1').click();
};

// document.getElementById('rzp-button1').onclick = function(e){
//     rzp1.open();
//     e.preventDefault();
// }
</script>


<form action="/payment-complete/{{Auth::user()->id}}/{{$data['srvdID']}}" method="POST" hidden>
    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
    <input type="text" class="form-control" id="rzp_paymentid" name="rzp_paymentid">
    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
    <input type="text" id="service_req_id" name="service_req_id" value="{{$data['srId']}}">
    <input type="text" name="amount" value="{{ $data['amount'] }}">
    <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
</form>



<!-- // Let's Click this button automatically when this page load using javascript -->
<!-- You can hide this button -->










{{-- {{$serviceRequest}} --}}











