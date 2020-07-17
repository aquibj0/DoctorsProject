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
        background: rgb(242, 170, 168);
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
            <p class="lead mb-5">
                Dear <span class="maroon">{{$patient->user->userFirstName}} {{$patient->user->userLastName}}</span>, A service request, <span class="maroon"><b>{{ $srvcReq->srId }}</b></span> has been 
                created againt the patient, <span>{{ $patient->patFirstName }} {{ $patient->patLastName }}</span>.
            </p>
        </div>
    </div>
</body>
</html>