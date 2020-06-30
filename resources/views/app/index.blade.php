@extends('layouts.app')
@section('content')

<section class="header">
    <div class="container">
        <div class="row" >
            <div class="col-md-3">
                <h2 class="maroon"><b>Dr. FFFFF LLLLL</b></h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Neque doloremque, nihil est ipsa nemo similique repellendus nisi, veniam fugit ullam ad odit fuga magnam vero asperiores placeat aut quam aperiam?</p>
                <div class="img"></div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="round-img">
                            <h4 class="maroon">Location 1</h4>
                            <div class="img"></div>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="round-img">
                            <div class="img"></div>
                            <h4 class="maroon">Location 2</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="round-img">
                                <h4 class="maroon">Location 3</h4>
                                <div class="img"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="header-brief">
                            <h4><b>Exceptional Care Close To You</b></h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</section>



<section class="service-section">
    <div class="container">
        <div class="heading text-center mb-5">
            <h2 class="maroon"><b>NEED TO CONSULT AN EXPERT</b></h2>
        </div>
        <div class="row">
{{--           
            @if (!empty($services))
                @foreach ($services as $service) --}}
                    <div class="col-md-4 mb-5">
                        <div class="service-card card mb-3">
                            <div class="card-body">
                                <h2>Ask a doctor</h2>
                            </div>
                        </div>
                        <a href="/ask-a-doctor" class="btn btn-primary ">Submit</a>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="service-card card mb-3">
                            <div class="card-body">
                                <h2>Video Consultation</h2>
                            </div>
                        </div>
                        <a href="/video-consultation" class="btn btn-primary ">Submit</a>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="service-card card mb-3">
                            <div class="card-body">
                                <h2>Clinic Appointment</h2>
                            </div>
                        </div>
                        <a href="/clinic-appointment" class="btn btn-primary ">Submit</a>
                    </div>
                {{-- @endforeach
            @endif --}}
        </div>
    </div>
</section>

{{-- <div class="container">


    <h2>
        <b>

            This is landing page
        </b>
    </h2>
    <div>
       
        
    </div>
</div> --}}
@endsection