@extends('admin.layouts.app')
@section('content')


<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ask-dcotor-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="register-block">
                                    <h2>Manage Appointment Calender</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @include('layouts.message')
                                <form action="{{ url('/admin/appointment/store') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                    
                                    <div class="form-row form-group">
                                        {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}
                                        <div class="row">
                                            <div class="col-md">
                                                <h2> Schedule</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-row">
                                                <div class="col-md-3">
                                                    <input type="date" name="start-date" class="form-control" id="start-date" value="date" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="end-date" class="form-control" id="end-date" value="date" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                                </div>
                                            {{-- </div>
                                            
                                            <div class="form-group form-row"> --}}
                                                <div class="col-md-3">
                                                    {{-- <input type="date" class="form-control" id="my_date_picker" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" max="{{ Carbon\Carbon::today()->add(15, 'days')->toDateString() }}">          --}}
                                                    <select name="docType" id="docType" class="form-control" required>
                                                        <option disabled selected>Select Doctor Type</option>
                                                        <option value="TD">Team Doctor</option>
                                                        <option value="ED">Expert Doctor</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="appType" id="appType" class="form-control" required>
                                                        <option disabled selected>Select Appointment Type</option>
                                                        <option value="V">Video</option>
                                                        <option value="C">Clinic</option>
                                                    </select>
                                                    {{-- <span id="location"></span> --}}
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
                                            <span id="clinic-section"></span>
                                        </div>
                                    </div>
                                    {{-- <div class="form-row form-group">
                                        <div class="col-md">
                                            <label for="appt" class="form-label">Select a time:</label>
                                             
                                        </div>
                                        <div class="col-md">

                                        </div>
                                    </div> --}}
                                    <div class="form-row form-group">
                                        <div class="col-md">
                            
                                            @for($i = Carbon\Carbon::createFromFormat('H:i', '08:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '15:00');$i->addMinute(30))
                                            <div class="row">    
                                                <div class="col-md" style="border: 1px solid black; text-align: center">
                                                <span><input type="checkbox" id="time" name="time[]" id="time" value="{{ $i->toTimeString() }}" checked>&nbsp;&nbsp;&nbsp;<label for="time">{{ $i->toTimeString() }}</label>&nbsp;&nbsp;&nbsp;</span>
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" id="time" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked><label for="time">{{ $i->toTimeString() }}</label>&nbsp;
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" id="time" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked><label for="time">{{ $i->toTimeString() }}</label>&nbsp;
                                                </div>
                                                <div class="col-md">
                                                <input type="checkbox" id="time" name="time[]" class="form-control" id="time" value="{{ $i->addMinute(30)->toTimeString() }}" checked><label for="time">{{ $i->toTimeString() }}</label>&nbsp;
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //date change
        $('#appType').on('change', function(){

            var app = $(this).val();
            var doc = $('#docType').val();
            if(app == 'C'){
                $.ajax({
                    url: '/getLocation',
                    type: 'get',
                    dataType: 'json',
                    success: function(data){
                        if(data){
                            $("#clinic-section").empty();
                            $("#clinic-section").append('<select name="clinic" id="clinic" class="form-control"></select>' );
                            $("#clinic").append("<option selected disabled>Select one</option>");
                            $.each(data, function(key, value){
                                $("#clinic").append("<option value='"+value+"'>"+key+"</option>");
                            });
                        }
                    },
                    error: function(){
                        console.log('error');
                    }
                
                });
            }else{
                if($('#location')){
                    $("#location").empty();
                    $("#location").append("<option selected disabled>Not Applicable</option>");
                }
            }
            
        });
    });
</script>


@endsection