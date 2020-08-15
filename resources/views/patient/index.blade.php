@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div> --}}
        <div class="col-md-8 mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="register-block">
                        <h2>Select Patient</h2>
                    </div>
                </div>
                <div class="col-md-12">

     

                    <div class="card" >
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Patient ID</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients  as $patient)
                                            <tr>
                                                <th scope="row">{{$patient->patId}}</th>
                                                <td>{{$patient->patFirstName}}</td>
                                                <td>{{$patient->patLastName}}</td>
                                                <td>{{$patient->patGender}}</td>
                                                <td>{{$patient->patAge}}</td>
                                                <td>
                                                @if($service == "AAQ")
                                                    <a href="{{ url('/ask-a-doctor/'.$patient->id) }}" class="btn btn-maroon  btn-sm">Select Patient</a>
                                                @elseif($service == "VED")
                                                    <a href="{{ url('/video-consultation/'.$patient->id) }}" class="btn btn-maroon  btn-sm">Select Patient</a>
                                                @elseif($service == "CLI")
                                                    <a href="{{ url('/clinic-appointment/'.$patient->id) }}" class="btn btn-maroon  btn-sm">Select Patient</a>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="text-center mb-5">
                            <h3 class="maroon mt-4"><b>New patient ?</b> &nbsp; <span>
                                @if($service == "AAQ")
                                    <a href="{{ url('/ask-a-doctor/0') }}" ><u>Click here</u></a>
                                @elseif($service == "VED")
                                    <a href="{{ url('/video-consultation/0') }}"><u>Click here</u></a>
                                @elseif($service == "CLI")
                                    <a href="{{ url('/clinic-appointment/0') }}"><u>Click here</u></a>
                                @else
                                    <a href="{{ url('/') }}"><u>Click here</u></a>
                                @endif
                            </span> </h3>
                        </div>
                   


                </div>
            </div>   
        </div>
    </div>





    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md">
                <h3 style="float:right"></h3>
            </div>
            <div class="col-md">
                <br>
                <br>
                
            </div>
        </div>
    </div>


</section>




@endsection