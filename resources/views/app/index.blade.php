@extends('layouts.app')
@section('content')

<section class="">
    <div class="row mt-2" >
        <div class="col-md" style="padding-left:30px;">
            <h3 class="maroon " style="margin-top:15px !important;"><b>Dr Gautam Khastgir </b></h3>
            <p class="mb-0"><span><b>MD, FRCS, FRCOG, FICOG</b></span>   </p>
                <p class="mb-0">Medical Director</p>
                    <p class="mb-0">Subspecialty in Reproductive</p>
                    <p class="mb-0">Medicine and Surgery</p>
                    <p class="mb-2">Gynecological Endoscopic Surgery</p>

            <div class="img">
                <img src="{{asset('image/IMAGE2.jpg')}}" alt="">
            </div>
        </div>
        <div class="col-md">
            <div class="round-img">
                <h4 class="maroon location-shown"><b>Salt Lake, Kolkata</b></h4>
                <div class="img">
                    <img class="image-round " src="{{asset('image/IMAGE1A.jpg')}}" alt="">
                </div>
                <h4 class="maroon location-hidden" ><b>Salt Lake, Kolkata</b></h4>

            </div>
            
        </div>
        <div class="col-md">
            <div class="round-img">
                <h4 class="maroon location-shown"><b>Elgin Road, Kolkata</b></h4>
                <div class="img">
                    <img class="image-round " src="{{asset('image/IMAGE1B.jpg')}}" alt="">
                </div>
                <h4 class="maroon location-hidden"><b>Elgin Road, Kolkata</b></h4>

                
            </div>
        </div>
        <div class="col-md">
            <div class="round-img">
                    <h4 class="maroon location-shown"><b>Chandannagar, Hoogly</b></h4>
                    <div class="img">
                        <img class="image-round " src="{{asset('image/Image1C.jpg')}}" alt="">
                    </div>
                    <h4 class="maroon location-hidden"><b>Chandannagar, Hoogly</b></h4>

            </div>
        </div>
        <div class="col-md-12">
            <div class="header-brief mb-3">
                <h3><b>Delivering GOD’s Creation to Mankind</b></h3>
            </div>
        </div>
    </div>
</section>


<section id="services" class="service-section">
    <div class="container">
        <div class="heading text-center mt-2 mb-3">
            <h2 class="maroon mb-3"><b>NEED TO CONSULT AN EXPERT</b></h2>
        </div>
        <div class="row mt-5">
            <div class="col-md-4  mb-2">
                <div class="service-card card mb-3">
                    <div class="card-body">
                        <h2>Ask a doctor</h2>

                        <div class="hide">
                            <p class="mb-0">Submit Patient Details</p>
                            <p class="mb-0">Upload Reports & Prescriptions</p>
                            @if(isset(App\Service::where('srvcShortName', 'AAQ')->first()->srvcPrice))
                            <p class="mb-0">Fees: Rs.{{App\Service::where('srvcShortName', 'AAQ')->first()->srvcPrice}}</p>
                            @endif
                            {{-- <p class="mb-0">Fees: Rs.200</p> --}}
                        </div>
                        
                    </div>
                </div>
                <a href="/user-patients/AAQ" class="btn btn-primary  mb-2">Submit</a>
            </div>

            <div class="col-md-4 mb-2">
                <div class="service-card card mb-3">
                    <div class="card-body">
                        <h2>Video Consultation</h2>
                        <div class="hide">
                            <p class="mb-0">Submit Patient Details</p>
                            <p class="mb-0">Book Video Appointment</p>
                            @if(isset(App\Service::where('srvcShortName', 'VTD')->first()->srvcPrice) && isset(App\Service::where('srvcShortName', 'VED')->first()->srvcPrice))
                            <p class="mb-0">Fees: Dr Khastgir Rs.{{App\Service::where('srvcShortName', 'VED')->first()->srvcPrice}}</p>
                            <p class="mb-0">Team Doctor Rs.{{App\Service::where('srvcShortName', 'VTD')->first()->srvcPrice}}</p>
                            @endif
                            {{-- <p class="mb-0">Fees: Dr Khastgir Rs 2000</p>
                            <p class="mb-0">Team Doctor Rs 1000</p> --}}
                        </div>
                    </div>
                </div>
                <a href="/user-patients/VED" class="btn btn-primary  mb-2">Submit</a>
            </div>

            <div class="col-md-4 mb-2">
                <div class="service-card card mb-3">
                    <div class="card-body">
                        <h2>Clinic Appointment</h2>

                        <div class="hide">
                            <p class="mb-0">Submit Patient Details</p>
                            <p class="mb-0">Book Clinic Appointment</p>
                            @if(isset(App\Service::where('srvcShortName', 'CED')->first()->srvcPrice) && isset(App\Service::where('srvcShortName', 'CTD')->first()->srvcPrice))
                            <p class="mb-0">Fees: Dr Khastgir Rs.{{App\Service::where('srvcShortName', 'CED')->first()->srvcPrice}}</p>
                            <p class="mb-0">Team Doctor Rs.{{App\Service::where('srvcShortName', 'CTD')->first()->srvcPrice}}</p>
                            @endif
                            {{-- <p class="mb-0">Fees: Dr Khastgir Rs 2000</p>
                            <p class="mb-0">Team Doctor Rs 1000</p> --}}
                        </div>
                    </div>
                </div>
                <a href="/user-patients/CLI" class="btn btn-primary  mb-2">Submit</a>
            </div>

            <div class="col-md-12 text-center">
                <p class="mb-0 maroon">For General Queries <a href="/contact-us" ><u>Contact Us</u></a></p>
            </div>
        </div>
    </div>
</section>
@endsection