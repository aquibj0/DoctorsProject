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
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center">
                                    <h2>Appointment Schedules for 
                                        @if($appointmentType == "VED")
                                            video
                                        @else 
                                            {{ App\Clinic::find($appointmentType)->clinicName }}
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
                            <div class="col-md" style="text-align: center">
                                <h2>{{ Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM, YYYY') }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="">Default Max</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="">Clear Flags</option>
                                    <option value="">Set Flags</option>
                                </select>
                            </div>
                        </div>
                        <form action="{{ url('/admin/appointment/store/'.$start_date.'/'.$end_date) }}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <table class="table table-bordered table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">Flag</th>
                                            <th scope="col">Max</th>
                                            <th scope="col">Bkd</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($appointments) == 0) <!-- For creating new Appointments  -->
                                            @if($appointmentType == "VED")
                                                @for($i = Carbon\Carbon::createFromFormat('H:i', '08:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '15:00');$i->addMinute(15))
                                                <tr>                                                
                                                    <td>
                                                        <input type="text" name="time[]" id="time" value="{{ $i->toTimeString() }}" class="form-control">
                                                    </td>
                                                    <td>    
                                                        <input type="checkbox" id="flag" name="flag[]" class="form-check-input" value="{{ $i->toTimeString() }}" checked>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="form-control" value="1" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="0" class="form-control">
                                                    </td>
                                                </tr>
                                                @endfor
                                            @else                                            
                                                @for($i = Carbon\Carbon::createFromFormat('H:i', '08:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '15:00');$i->addMinute(30))
                                                <tr>                                                
                                                    <td>
                                                        <input type="text" name="time[]" id="time" value="{{ $i->toTimeString() }}" class="form-control">
                                                    </td>
                                                    <td>    
                                                        <input type="checkbox" id="flag" name="flag[]" class="form-check-input" value="{{ $i->toTimeString() }}" checked>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="form-control" value="6" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="0" class="form-control">
                                                    </td>
                                                </tr>
                                                @endfor
                                            @endif
                                            <input type="hidden" name="submit_type" value="new">
                                        @else
                                            @if($appointmentType == "VED")
                                                @foreach($appointments as $item)
                                                <tr>                                                
                                                    <td>
                                                        <input type="text" name="time[]" id="time" value="{{ $item->appmntSlot }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if($item->appmntFlag == 1)    
                                                            <input type="checkbox" id="flag{{$loop->iteration}}" name="flag[]" class="form-check-input" value="{{ $item->appmntSlot}}" checked>
                                                        @else
                                                            <input type="checkbox" id="flag{{$loop->iteration}}" name="flag[]" class="form-check-input" value="{{ $item->appmntSlot }}">
                                                        @endif
                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                                        <script>
                                                            $(document).ready(function(){
                                                                if($('flag{{$loop->iteration}}').prop('checked')){
                                                                    $('flag{{$loop->iteration}}').val("{{ $item->appmntSlot }}");
                                                                }else{
                                                                    $('flag{{$loop->iteration}}').val("0");   
                                                                }
                                                            });
                                                        </script>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="form-control" value="{{ $item->appmntSlotMaxCount }}" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="{{ $item->appmntSlotFreeCount }}" class="form-control">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                @foreach($appointments as $item)
                                                <tr>                                                
                                                    <td>
                                                        <input type="text" name="time[]" id="time" value="{{ $item->appmntSlot }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        @if($item->appmntFlag == 1)    
                                                            <input type="checkbox" id="flag" name="flag[]" class="form-check-input" value="{{ $item->appmntSlot}}" checked>
                                                        @else
                                                            <input type="checkbox" id="flag" name="flag[]" class="form-check-input" value="{{ $item->appmntSlot }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="form-control" value="{{ $item->appmntSlotMaxCount }}" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="{{ $item->appmntSlotFreeCount }}" class="form-control">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            <input type="hidden" name="submit_type" value="old">
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" style="float:right" class="btn btn-maroon">Save</button>
                                </div>
                                <div class="col-md-6">
                                    or <a href="/admin/appointiment">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="appointmentType" value="{{$appointmentType}}">
                            <input type="hidden" name="docType" value="{{$docType}}">
                            <input type="hidden" name="date" value="{{$date}}">
                        </form>
                        {{-- <form action="{{ url('/admin/appointment/store') }}" method="POST">
                            {{ csrf_field() }}
                            
                            
                            <div class="form-row form-group">
                                
                            </div>
                            <div class="form-row form-group">
                                <div class="col-md">                            
                                    
                                    @if($appointmentType == "VED")
                                        @for($i = Carbon\Carbon::createFromFormat('H:i', '08:00') ; $i< Carbon\Carbon::createFromFormat('H:i', '15:00');$i->addMinute(30))
                                        <div class="row">    
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->toTimeString() }}" checked>
                                                            <label class="form-check-label" for="time">{{ $i->toTimeString() }}</label>
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="freecount[]" id="freecount" class="form-control" value="5" placeholder="" onkeypress="return onlyNumberKey(event)" >
                                                        </div>
                                                        <div class="col-md">
                                                            <input type="text" name="booked[]" id="booked" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group form-check">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(15)->toTimeString() }}" checked>
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
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(15)->toTimeString() }}" checked>
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
                                                            <input type="checkbox" id="time" name="time[]" class="form-check-input" id="time" value="{{ $i->addMinute(15)->toTimeString() }}" checked>
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
                                            <br>
                                        @endfor
                                    @else 
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
                                    @endif
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <div class="col-md">
                                    <button type="sbumit" class="form-control">Add/Update</button>
                                </div>
                            </div>
                        </form>
                        {{ $appointments }} --}}
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