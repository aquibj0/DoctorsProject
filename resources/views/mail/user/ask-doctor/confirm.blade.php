<!DOCTYPE html>
<html>
<head>
    <title>Laravel Mail Queue Tutorial</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--Custom Styles --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>
    .jumbotron{
        /* background: rgb(242, 170, 168); */
        border: none;
        border-radius: 6px;
    }
    .jumbotron img{
        border-radius: 8px;
        margin-bottom: 8px;
    }
    </style>
</head>
<body>  
    <div class="container">
        <div class="jumbotron">
            <img src="{{asset('image/logo2.png')}}" class="mt-4" alt="">
            <p>We are in receipt of your request no <span class="maroon"><b>{{ $srvcReq->srId }}</b></span>   dated <span class="maroon"><b>{{ $srvcReq->srRecievedDateTime }}</b></span>   for </p>

            <p>Patient Name : <span>{{ $patient->patFirstName }} {{ $patient->patLastName }}</span>  </p>                
            <p>Age : <span>{{ $patient->patAge }} </span>     </p>           
            <p>Gender : <span>{{ $patient->patGender }} </span> </p>
            <p>Address :<span>{{ $patient->AddressLine1 }} </span>  </p>
                           

            <p>Please upload your documents ( prescriptions and reports not older than 3 months ) through the application.</p>

            <p>We will try our best to respond within 24 hours</p>

            <p>We acknowledge receipt of Rs.{{$srvcReq->service->srvcPrice}}.00 against the above service. Your payment reference and traction details are as below : </p>

            <p>Payment Amount :  Rs.{{$srvcReq->service->srvcPrice}}.00</p>
            {{-- <p>Payment Mode :  Credit card / Net Banking etc</p> --}}
            <p>Transaction ID : {{ $payment->payment_transaction_id }}	</p>
            <p>Transaction Time: {{ $payment->created_at }}</p>


            Regards
            Email id of Clinic

            For BIRTH
            BIRTH Registration No : 
            {{-- <p class="lead mb-5">
                Dear <span class="maroon">{{$patient->user->userFirstName}} {{$patient->user->userLastName}}</span>, A service request, has been 
                created againt the patient, .
            </p> --}}
        </div>
    </div>
</body>
</html>