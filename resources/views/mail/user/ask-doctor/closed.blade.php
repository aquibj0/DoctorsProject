<!DOCTYPE html>
<html>
<head>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--Custom Styles --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>
 
    .jumbotron img{
        max-width: 180px;
        border-radius: 8px;
        margin-bottom: 8px;
    }
    </style>
</head>
<body>  
    <div class="container">
        <div class="jumbotron">
            <img src="{{asset('image/logo2.jpg')}}" class="mt-4" alt="">
            <p class="lead mb-2">
                Dear <span class="maroon"><b>{{$patient->patFirstName}} {{$patient->patLastName}}</b></span>, <br>
            </p>
            <p class="lead">Thank you for availing Birth's eclinic services to book your appointment. Your invoice has been generated. Please click <a href="{{url('generate-invoice/'.$srvcReq->srId)}}">here for a copy of your invoice.</a></p>
            <p class="lead">For any help and query please contact, birtheclinic@gmail.com</p>

            <p class="lead">Best Regards</p>
            <p class="lead">Team Birth</p>
            <p class="lead">https://birth.eclinic.com</p>
        </div>
    </div>
</body>
</html>