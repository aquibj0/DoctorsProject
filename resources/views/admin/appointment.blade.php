@extends('admin.layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        {{-- <div class="col-md-4" style="background:#142cd6; height:100vh;"></div>
        <div class="col-md-8" style=" height:100vh;">
             --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="ask-dcotor-form">
                        <div class="register-block">
                           <h2>Manage Appointment Calender</h2>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @include('layouts.message')
                                <form action="{{ url('/admin/appointment/store') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                    
                                    <div class="form-row form-group">
                                        {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}
            
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <label for="date" class="form-control-label">Schedule</label>
                                                </div>
                                                <div class="col-sm">
                                                    <input type="date" name="date" class="form-control" id="my_date_picker" value="date" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" max="{{ Carbon\Carbon::today()->add(15, 'days')->toDateString() }}" required>         
                                                </div>
                                                <div class="col-sm">
                                                    {{-- <input type="date" class="form-control" id="my_date_picker" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" max="{{ Carbon\Carbon::today()->add(15, 'days')->toDateString() }}">          --}}
                                                    <select name="appType" id="appType" class="form-control" required>
                                                        <option disabled selected>Select One</option>
                                                        <option value="VED">Video Call with Expert Doctor</option>
                                                        <option value="VTD">Video Call with Team Doctor</option>
                                                        <option value="CLI">Clinic Appointment</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-md">
                                            @for($i = Carbon\Carbon::createFromFormat('H:i', '09:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '17:00');$i->addMinute(30))
                                            <div class="row">    
                                                <div class="col-md">
                                                
                                                <input type="checkbox" name="time[]" class="form-control" id="time" value="{{ $i->toTimeString() }}" checked>{{ $i->toTimeString() }}&nbsp;
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>{{ $i->toTimeString() }}&nbsp;
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>{{ $i->toTimeString() }}&nbsp;
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked>{{ $i->toTimeString() }}&nbsp;
                                                </div>
                                            </div>
                                                <br>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-md">
                                            <button type="sbumit" class="form-control">Add/Update</button>
                                        </div>
                                        <div class="col-md">
                                            <button class="form-control">Reset</button>
                                        </div>
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