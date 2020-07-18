@extends('admin.layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="ask-dcotor-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="register-block">
                            <h2>Manage Clinic Appointment Calender</h2>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @include('layouts.message')
                        <form action="{{ url('/admin/appointment/store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-row form-group">
                                <div class="row">
                                    <div class="col-md">
                                        <h2> Schedule</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-row">
                                        <div class="col-md-4">
                                            <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                        </div>
                                        <div class="col-md-4">
                                            <select name="docType" id="docType" class="form-control" required>
                                                <option disabled selected>Select Doctor Type</option>
                                                <option value="CTD">Team Doctor</option>
                                                <option value="CED">Expert Doctor</option>
                                            </select>
                                        </div>
                                        <div class="col-md">
                                            <select name="clinic_id" id="clinic_id" class="form-control" required>
                                                <option disabled selected>Select Clinic</option>
                                                @foreach($clinics as $clinic)
                                                    <option value="{{ $clinic->id }}">{{ $clinic->clinicName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @if ($errors->has('date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md">
                                        @for($i = Carbon\Carbon::createFromFormat('H:i', '08:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '15:00');$i->addMinute(30))
                                        <div class="row">    
                                            <div class="col-md">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>
                                                            <label class="form-check-label" for="time">{{ $i->toTimeString() }}</label>
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="freecount[]" id="freecount" class="form-control" value="5" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                        </div>
                                                        <div class="col-md"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>
                                                            <label class="form-check-label" for="time">{{ $i->toTimeString() }}</label>
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="freecount[]" id="freecount" class="form-control" value="5" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                        </div>
                                                        <div class="col-md"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>
                                                            <label class="form-check-label" for="time">{{ $i->toTimeString() }}</label>
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="freecount[]" id="freecount" class="form-control" value="5" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                        </div>
                                                        <div class="col-md"></div>
                                                    </div>
                                                </div>
                                            </div><div class="col-md">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>
                                                            <label class="form-check-label" for="time">{{ $i->toTimeString() }}</label>
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="freecount[]" id="freecount" class="form-control" value="5" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                        </div>
                                                        <div class="col-md"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="form-row form-group">
                                    <div class="col-md">
                                        <button type="sbumit" class="form-control btn-maroon btn-md">Add appointments</button>
                                    </div>
                                    <div class="col-md">
                                        <button class="form-control btn-maroon" disabled>Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
<script> 
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script> 
@endsection