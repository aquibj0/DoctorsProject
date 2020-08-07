<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BIRTH') }}&nbsp;Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> --}}
    <!-- Include whatever JQuery which you are using -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    
    {{-- <script src="https://kit.fontawesome.com/b8deba5ede.js" crossorigin="anonymous"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--Custom Styles --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('image/logo.jpg')}}" style="max-width:60px;" alt="">
                <img src="{{asset('image/logo2.jpg')}}" alt="" style="max-width:55%;">
            </a>                
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">Home </a>
                    </li>
                    @guest('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a href="/admin/internal-user" class="nav-link">Internal User </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/clinic" class="nav-link">Clinic </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/departments" class="nav-link">Departments</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/services" class="nav-link">Services</a>
                    </li>
                    @endguest
                    
                    
                    <!-- Authentication Links -->
                    @guest('admin')
                        

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.auth.login') }}">{{ __('Login') }}</a>
                        </li> --}}
                    @else
                        <li class="nav-item">
                            <a href="/admin/appointment" class="nav-link">Appointment</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstName." ".Auth::user()->lastName }} <span class="caret"></span>

                            </a>
                            

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href=" /service-request/{{Auth::user()->id}}">My Services </a> --}}
                                <a class="dropdown-item" href="/admin">Dashboard </a>
                                <a class="dropdown-item" href="/admin/setting/{{Auth::user()->id}}">My Profile </a>


                                    
                                <a class="dropdown-item" href="{{ route('admin.auth.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main >
            @yield('content')
        </main>
    </div>
</body>
</html>
