@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="register-block mt-4 mb-4">
                <h2>Contact Us</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <img class="mb-4"  src="{{asset('image/contact.jpg')}}" style="max-width:80%;" alt="">
        </div>
        <div class="col-md-8">

            
            <div class="card">
                <div class="card-body user-login-form">
                    @include('layouts.message')
                    <form action="{{ url('/contact-us') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                            </div>
                       
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control" id="phone" placeholder="Phone No" name="phone" value="{{ old('phone') }}" required>
                            </div>
                       
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{ old('address') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" value="{{ old('subject') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                {{-- <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" value="{{ old('subject') }}" required> --}}
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Type your message here..."></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-maroon btn-md" style="width:100%">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
