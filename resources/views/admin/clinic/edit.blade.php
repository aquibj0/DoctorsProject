@extends('admin.layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row" style="height:auto">
        {{-- <div class="col-md-4">
            <div style="background:#142cd6;">

                <img src="{{asset('image/IMAGE6.jpg')}}" style="max-width:100%" alt="">
            </div>
        </div> --}}


        <div class="col-md-8" >
            
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="ask-dcotor-form">
                            <div class="register-block">
                                <h2>Edit Clinic</h2>
                            </div>   
                            <div>
                                @include('layouts.message')
                                <form action="{{ url('/admin/clinic/update/'.$clinic->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="mb-2">
                                    </div>
    
                                    <div class="form-row">
                                        {{--Clinic Name Input --}}
                                        <div class="form-group col-md">
                                            <input type="text" class="form-control @error('clinicName') is-invalid @enderror" id="clinicName" placeholder="Clinic Name" name="clinicName" value="{{ $clinic->clinicName }}" required>
                                                @error('clinicName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="form-row">
                                        {{-- Clinic mobile number Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" placeholder="Mobile No" id="clinicMobileNo" class="form-control @error('clinicMobileNo') is-invalid @enderror" name="clinicMobileNo" value="{{ $clinic->clinicMobileNo }}" autocomplete="clinicMobileNo" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                            
                                            @error('clinicMobileNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        {{-- Clinic Landline No Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" placeholder="Landline No" id="clinicLandLineNo" class="form-control @error('clinicLandLineNo') is-invalid @enderror" name="clinicLandLineNo" value="{{ $clinic->clinicLandLineNo }}" autocomplete="clinicLandLineNo" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                                            
                                            @error('clinicLandLineNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
    
                                        
                                    </div>
                                    <div class="form-row">
                                        {{-- Clinic Address Line 1 Input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('clinicAddressLine1') is-invalid @enderror" id="clinicAddressLine1" placeholder="Address Line 1" name="clinicAddressLine1" value="{{ $clinic->clinicAddressLine1 }}" required>
                                        
                                            @error('clinicAddressLine1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        {{-- Clinic Address Line 2 input --}}
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control @error('clinicAddressLine2') is-invalid @enderror" id="clinicAddressLine2" placeholder="Address Line 2" name="clinicAddressLine2" value="{{ $clinic->clinicAddressLine2 }}" >
                                            @error('clinicAddressLine2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="form-row">
                                        {{-- clinic City Input --}}
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control"class="form-control @error('clinicCity') is-invalid @enderror" id="clinicCity" placeholder="City" name="clinicCity" value="{{ $clinic->clinicCity }}" required>
                                                @error('clinicCity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    
                                            {{-- clinic District Input --}}
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control @error('clinicDistrict') is-invalid @enderror" id="clinicDistrict" placeholder="District" name="clinicDistrict" value="{{ $clinic->clinicDistrict }}">
                                                @error('clinicDistrict')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
    
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                {{-- Clinic state Input --}}
                                                <input type="text" class="form-control"class="form-control @error('clinicState') is-invalid @enderror" id="clinicState" placeholder="State" name="clinicState" value="{{ $clinic->clinicState }}" required>
                                                @error('clinicState')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                {{-- Clinc Country Input --}}
                                                <input type="text" class="form-control"class="form-control @error('clinicCountry') is-invalid @enderror" id="clinicCountry" placeholder="Country" name="clinicCountry" value="{{ $clinic->clinicCountry }}" required>
                                                @error('clinicCountry')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            {{-- Clinc Pincode Input --}}
                                            <input type="text" class="form-control"class="form-control @error('clinicPincode') is-invalid @enderror" id="clinicPincode" placeholder="Pincode" name="clinicPincode" value="{{ $clinic->clinicPincode }}" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6">
                                            @error('clinicPincode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
    
                                    <button type="submit" class="btn btn-maroon btn-md mt-2" style="width:100%">SUBMIT</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ url()->previous() }}" class=" text-center mt-4 mb-2"><u>Back</u></a>
                                   </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        
        </div>
    </div>


</section>




@endsection