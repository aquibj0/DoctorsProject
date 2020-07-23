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
                {{-- <div class="card-header">
                </div> --}}
                <div class="card-body">
                    <div class="container">
                        <form action="{{ url('/admin/appointment/check') }}" method="POST">
                            {{csrf_field()}}
                            <div class="form-row form-group">
                                <div class="col-md-">
                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{ old('start_date') }}" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="end_date" class="form-control" id="end_date" value="{{ old('end_date') }}" min="{{ Carbon\Carbon::today()->add(1, 'day')->toDateString() }}" required>         
                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <select name="doctor_type" id="doctor_type" class="form-control">
                                        <option disabled selected>Select one</option>
                                        <option value="ED">Dr. Khastgir</option>
                                        <option value="TD">Birth Team Doctor</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="appointment_type" id="appointment_type" class="form-control">
                                        <option disabled selected>Select one</option>
                                        <option value="VED">Video Appointment</option>
                                        @foreach($clinics as $clinic)
                                            <option value="{{ $clinic->id }}">{{ $clinic->clinicName }}-Clinic</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="container"> --}}
                                    <div class="form-row form-group">
                                        <div class="col-md">
                                            <button type="sbumit" class="form-control btn-maroon btn-md">Add appointments</button>
                                        </div>
                                        {{-- <div class="col-md">
                                            <button class="form-control btn-maroon" disabled>Reset</button>
                                        </div> --}}
                                    </div>
                                {{-- </div> --}}
                            </div>
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
                                            clinic
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
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/VTD" class="btn btn-md btn-maroon">Add/Edit</a>
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/VTD/delete" class="btn btn-md btn-maroon">Delete</a>
                                                    @else
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/VED" class="btn btn-md btn-maroon">Add/Edit</a>
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/VED/delete" class="btn btn-md btn-maroon">Delete</a>
                                                    @endif
                                                {{-- @else
                                                    @if($docType == "TD")
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/CTD/{}" class="btn btn-md btn-maroon">Add/Edit</a>
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/CTD/delete" class="btn btn-md btn-maroon">Delete</a>
                                                    @else
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/CED" class="btn btn-md btn-maroon">Add/Edit</a>
                                                        <a href="/admin/appointment/{{ $data[$i]['date'] }}/CED/delete" class="btn btn-md btn-maroon">Delete</a>
                                                    @endif --}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endfor
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    {{-- <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right"></th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Appointment Time</th>
                                <th scope="col">Appointment Type & Clinic</th>
                                <th scope="col">Appointment Max Count</th>
                                <th scope="col">Appointment Booked Count</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $appointment->appmntDate }}</td>
                                    <td>{{ $appointment->appmntSlot }}</td>
                                    <td>{{ $appointment->appmntType }}
                                        @if($appointment->appmntClinicid)
                                            &nbsp;&nbsp;&nbsp;{{ \App\Clinic::where('id', $appointment->appmntClinicid)->first()->clinicName }}
                                        @endif
                                    </td>
                                    <td>{{ $appointment->appmntSlotMaxCount }}</td>
                                    <td>{{ $appointment->appmntSlotMaxCount-$appointment->appmntSlotFreeCount }}</td>
                                    <td>
                                        <button type="button" class="btn btn-maroon btn-sm" data-toggle="modal" data-target="#ModalCenter{{$appointment->id}}">
                                            Edit
                                        </button>
                                        <!--Edit appointment Modal -->
                                        <div class="modal fade" id="ModalCenter{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Edit Appointment</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <form action="{{url('/admin/appointment/update/'.$appointment->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <!-- department_name Input -->
                                                            <label for="appmntSlotMaxCount" class="maroon">Appointment Slot Max Count</label>
                                                            <input type="text" class="form-control"class="form-control @error('appmntSlotMaxCount') is-invalid @enderror" id="appmntSlotMaxCount"  name="appmntSlotMaxCount" maxlength="2" value="{{$appointment->appmntSlotMaxCount}}" onkeypress="return onlyNumberKey(event)">
                                                            @error('appmntSlotMaxCount')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-maroon btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div> 

                                        @if($appointment->appmntSlotMaxCount-$appointment->appmntSlotFreeCount == 0)
                                            <a href="#" data-toggle="modal" data-target="#{{ 'deleteApp'.$appointment->id }}" class="btn btn-maroon btn-sm">Delete</a>
                                            <!--Delete Appointment Modal -->
                                            <div class="modal fade" id="{{ 'deleteApp'.$appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Delete Appointment</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <form action="{{url('/admin/appointment/delete/'.$appointment->id)}}" method="post">
                                                            @csrf
                                                            
                                                            <div class="modal-body">
                                                                <h5 > Confirm Delete <b class="maroon">{{$appointment->appmntSlot}} on {{ $appointment->appmntDate }} of {{ $appointment->appmntType }} ?</b></h5>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure?')">Delete </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif                                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
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