@extends('admin.layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0"> 
    
    <div class="row" style="height:auto">
       
        <div class="col-md-8" >
            
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="ask-dcotor-form">
                            <div class="register-block">
                                <h2>ADD SERVICE</h2>
                            </div>   
                            <div>
                                @include('layouts.message')
                                <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        {{-- department_name Input --}}
                                        <input type="text" class="form-control @error('srvcName') is-invalid @enderror" id="srvcName" placeholder="Service Name" name="srvcName" value="{{ old('srvcName') }}" maxlength="40" required>
                                        @error('srvcName')                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{-- department_name Input --}}
                                        <input type="text" class="form-control @error('srvcShortName') is-invalid @enderror" id="srvcShortName" placeholder="Service Short Name" name="srvcShortName" value="{{ old('srvcShortName') }}" maxlength="6" required>
                                        @error('srvcShortName')                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{-- department_name Input --}}
                                        <input type="text" class="form-control @error('srvcPrice') is-invalid @enderror" id="srvcPrice" placeholder="Service Rate" name="srvcPrice" value="{{ old('srvcPrice') }}" required>
                                        @error('srvcPrice')                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-maroon btn-md mb-2" style="width:100%">Submit</button>
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