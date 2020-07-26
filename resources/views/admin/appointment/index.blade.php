@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>Appointment Schedules</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-body">
                    <div class="container">
                        <form action="{{ url('/admin/appointment/check') }}" method="POST">
                            {{csrf_field()}}
                            @if($start_date != 0 && $end_date !=0 )
                                <div class="form-row form-group">
                                    <div class="col-md">
                                        <input type="date" name="start_date" class="form-control" id="start_date_self" value="{{ $start_date }}">         
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input type="hidden" id="counter" name="counter" value="{{ $counter }}">
                                    <div class="col-md">
                                        <input type="date" name="end_date" class="form-control" id="end_date_self" value="{{ $end_date }}">         
                                        @if ($errors->has('end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md">
                                        <select name="doctor_type" id="doctor_type" class="form-control">
                                            {{-- <option disabled selected>Select one</option> --}}
                                            @if($docType == "ED")
                                                <option value="ED" selected>Dr. Khastgir</option>
                                                <option value="TD">Birth Team Doctor</option>
                                            @else
                                                <option value="ED">Dr. Khastgir</option>
                                                <option value="TD" selected>Birth Team Doctor</option>
                                            @endif
                                        </select>
                                        {{-- <input type="text" name="doctor_type" id="doctor_type" value="{{ $docType }}"> --}}
                                    </div>
                                    <div class="col-md">
                                        <select name="appointment_type" id="appointment_type" class="form-control">
                                            {{-- <option disabled>Select one</option> --}}
                                            @if($appointmentType == "VED")
                                                <option value="VED" selected>Video Appointment</option>
                                                @foreach($clinics as $clinic)
                                                    <option value="{{ $clinic->id }}">{{ $clinic->clinicName }}-Clinic</option>
                                                @endforeach
                                            @else
                                                <option value="VED">Video Appointment</option>
                                                @foreach($clinics as $clinic)
                                                    @if($appointmentType == $clinic->id)
                                                        <option value="{{ $clinic->id }}" selected>{{ $clinic->clinicName }}-Clinic</option>
                                                    @else
                                                        <option value="{{ $clinic->id }}">{{ $clinic->clinicName }}-Clinic</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- <input type="text" name="appointment_type" id="appointment_type" value="{{ $appointmentType }}"> --}}
                                    </div>
                                    <div class="col-md">
                                        <button type="sbumit" id="self_submit" class="form-control btn-maroon btn-md">Search appointments</button>
                                    </div>
                                </div>
                            @else
                                <div class="form-row form-group">
                                    <div class="col-md">
                                        <input type="date" name="start_date" class="form-control" id="start_date" value="{{ old('start_date') }}" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md">
                                        <span id="end">
                                            <input type="date" name="end_date" class="form-control" id="end_date" value="{{ old('end_date') }}" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                        </span>
                                        @if ($errors->has('end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md">
                                        <select name="doctor_type" id="doctor_type" class="form-control">
                                            <option disabled selected>Select one</option>
                                            <option value="ED">Dr. Khastgir</option>
                                            <option value="TD">Birth Team Doctor</option>
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <select name="appointment_type" id="appointment_type" class="form-control">
                                            <option disabled selected>Select one</option>
                                            <option value="VED">Video Appointment</option>
                                            @foreach($clinics as $clinic)
                                                <option value="{{ $clinic->id }}">{{ $clinic->clinicName }}-Clinic</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <button type="sbumit" class="form-control btn-maroon btn-md">Search appointments</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                    @if($show == 1)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="register-block">
                                        <h2>Appointment Schedules for 
                                            @if($appointmentType == "VED")
                                                video
                                            @else 
                                                @foreach($clinics as $clinic)
                                                    @if($appointmentType == $clinic->id)
                                                        {{$clinic->clinicName}}
                                                    @endif
                                                @endforeach
                                                - Clinic 
                                            @endif
                                            with
                                            @if($docType == "ED")
                                                Dr. Khastgir
                                            @else
                                                Birth Team Doctor
                                            @endif
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-bordered table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Day</th>
                                            <th scope="col">Schedule Exists?</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                        @for ($i = 0;$i < count($data);$i++)
                                            <tr>
                                                <td>{{ $data[$i]['date'] }}</td>
                                                <td>{{ $data[$i]['day'] }}</td>
                                                <td>
                                                    @if($data[$i]['created'] == 1)
                                                        Created
                                                    @else
                                                        None
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($appointmentType == "VED")
                                                        @if($docType == "TD")
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/VTD/{{ $start_date }}/{{$end_date}}" class="btn btn-md btn-maroon">Add/Edit</a>
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/VTD//{{ $start_date }}/{{$end_date}}/delete" class="btn btn-md btn-maroon">Delete</a>
                                                        @else
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/VED/{{ $start_date }}/{{$end_date}}" class="btn btn-md btn-maroon">Add/Edit</a>
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/VED//{{ $start_date }}/{{$end_date}}/delete" class="btn btn-md btn-maroon">Delete</a>
                                                        @endif
                                                    @else
                                                        @if($docType == "TD")
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/CTD/{{ $appointmentType }}/{{ $start_date }}/{{$end_date}}" class="btn btn-md btn-maroon">Add/Edit</a>
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/CTD/{{ $appointmentType }}/{{ $start_date }}/{{$end_date}}delete" class="btn btn-md btn-maroon">Delete</a>
                                                        @else
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/CED/{{ $appointmentType }}/{{ $start_date }}/{{$end_date}}" class="btn btn-md btn-maroon">Add/Edit</a>
                                                            <a href="/admin/appointment/{{ $data[$i]['date'] }}/CED/{{ $appointmentType }}/{{ $start_date }}/{{$end_date}}/delete" class="btn btn-md btn-maroon">Delete</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
    function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    }
    $(document).ready(function(){

            var counter = $("#counter").val();

            if($("#start_date_self").val() != 0 && counter < 1){
                // console.log(x);
                
                counter++;
                $("#self_submit").click();
            }else{
                
                console.log(counter);
            }

            
    });
</script> 
@endsection