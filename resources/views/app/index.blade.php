@extends('layouts.app')
@section('content')

<section class="">
    <div class="row mt-2" >
        <div class="col-md" style="padding-left:30px;">
            <h3 class="maroon"><b>Dr Gautam Khastgir </b></h3>
            <p class="mb-0"><span><b>MBBS, MD, MRCOG</b></span>   </p>
                <p>MD, FRCS, FRCOG, FICOG
                    Medical Director
                    Subspecialty in Reproductive
                    Medicine and Surgery
                    Gynecological Endoscopic
                    Surgery</p>
            <div class="img">
                <img src="{{asset('image/IMAGE2.jpg')}}" alt="">
            </div>
        </div>
        <div class="col-md">
            <div class="round-img">
                <h4 class="maroon"><b>Salt Lake, Kolkata</b></h4>
                <div class="img">
                    <img class="image-round " src="{{asset('image/IMAGE1A.jpg')}}" alt="">
                </div>
            </div>
            
        </div>
        <div class="col-md">
            <div class="round-img">
                <h4 class="maroon"><b>Elgin Road, Kolkata</b></h4>
                <div class="img">
                    <img class="image-round " src="{{asset('image/IMAGE1B.jpg')}}" alt="">
                </div>
                
            </div>
        </div>
        <div class="col-md">
            <div class="round-img">
                    <h4 class="maroon"><b>Chandannagar, Hoogly</b></h4>
                    <div class="img">
                        <img class="image-round " src="{{asset('image/Image1C.jpg')}}" alt="">
                    </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="header-brief mb-3">
                <h4><b>Delivering GOD’s Creation to Mankind</b></h4>
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
                    </div>
                </div>
                <a href="/user-patients/AAQ" class="btn btn-primary  mb-2">Submit</a>
            </div>

            <div class="col-md-4 mb-2">
                <div class="service-card card mb-3">
                    <div class="card-body">
                        <h2>Video Consultation</h2>
                    </div>
                </div>
                <a href="/user-patients/VED" class="btn btn-primary  mb-2">Submit</a>
            </div>

            <div class="col-md-4 mb-2">
                <div class="service-card card mb-3">
                    <div class="card-body">
                        <h2>Clinic Appointment</h2>
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