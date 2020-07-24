<!DOCTYPE html>
<html>
<head>
    <title>Laravel Mail Queue Tutorial</title>
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
            <p class="lead mb-5">
                Dear <span class="maroon"><b>{{$user->firstName}} {{$user->lastName}}</b></span>, <br>
                Your account has been created with Birth.
                <br>
                <hr>
                Your credentials: <br>
                Username: <b>{{ $user->email }}</b>,<br>
                Password: <b>{{ $password }}</b>
                <br>
                <hr>
                <br>
                Please login and complete your profile.
                <br>
            </p>
        </div>
    </div>
</body>
</html>