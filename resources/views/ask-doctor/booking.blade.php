@extends('layouts.app')
@section('content')


<section class="booking-confirmed mt-4">
    <div class="container">

        
        <div class="card">
            <div class="card-body">

                <h2 class="maroon"><b>Hi {{Auth::user()->userFirstName}} {{Auth::user()->userLastName}} your booking confirmed with us, please find the details below.</b></h2>
                <p><b>Booking ID</b> : <span>{{$serviceRequest->srId}}</span></p>         
                <p><b>Patient  Name</b> : <span>{{$serviceRequest->patient->patFirstName}} {{$serviceRequest->patient->patLastName}}</span></p>    
                <p><b>Patient Gender</b> : <span>{{$serviceRequest->patient->patGender}}</span></p>
                <p><b>Patient Age</b> : <span>{{$serviceRequest->patient->patAge}}</span></p>
                <p><b>Patient Background</b> : <span>{{$serviceRequest->patient->patBackground}}</span></p>
                <p><b>Service Amount</b> : <span>₹{{ $serviceRequest->service->srvcPrice}}</span></p>
                
                {{-- <form action="/payment-inititate-request" method="POST">
                    @csrf

                    <input type="hidden" name="payment_amount" id="payment_amount" value="{{ $serviceRequest->service->srvcPrice}}">
                    <input type="hidden" name="payment_transaction_id" id="payment_transaction_id">
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                </form> --}}

            </div>
        </div>
    </div>
</section>










{{-- {{$serviceRequest}} --}}


@endsection








