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
                                <input type="number" name="max" id="max" class="form-control" placeholder="Default" min="1" max="10" onkeypress="return onlyNumberKey(event)">
                            </div>
                            <div class="col-md-3">
                                <select name="" id="manipulate-checkbox" class="form-control">
                                    <option selected disabled>Select one</option>
                                    <option value="1">Clear Flags</option>
                                    <option value="2">Set Flags</option>
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
                                                        <input type="checkbox" id="flag" name="flag[]" class="flag form-check-input" value="{{ $i->toTimeString() }}" checked>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="freecount form-control" value="1" placeholder="" onkeypress="return onlyNumberKey(event)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="0" class="form-control" readonly="readonly">
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
                                                        <input type="checkbox" id="flag" name="flag[]" class="flag form-check-input" value="{{ $i->toTimeString() }}" checked>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="freecount form-control" value="6" placeholder="" onkeypress="return onlyNumberKey(event)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="0" class="form-control" readonly="readonly">
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
                                                            <input type="checkbox" id="flag{{$loop->iteration}}" name="flag[]" class="flag form-check-input" value="{{ $item->appmntSlot}}" checked>
                                                        @else
                                                            <input type="checkbox" id="flag{{$loop->iteration}}" name="flag[]" class="flag form-check-input" value="{{ $item->appmntSlot }}">
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
                                                        <input type="text" name="freecount[]" id="freecount{{$loop->iteration}}" class="freecount form-control" value="{{ $item->appmntSlotMaxCount }}" placeholder="" onkeypress="return onlyNumberKey(event)">
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#freecount{{$loop->iteration}}").on('change', function(){
                                                                    if($(this).val()-$("#booked{{$loop->iteration}}").val() < 0){
                                                                        console.log("yes");
                                                                        // $(this).val($item->appmntSlotMaxCount-$item->appmntSlotFreeCount);
                                                                        console.log("Cannot reduce the value of ");
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked{{$loop->iteration}}" value="{{ $item->appmntSlotMaxCount-$item->appmntSlotFreeCount }}" class="form-control" readonly="readonly">
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
                                                            <input type="checkbox" id="flag" name="flag[]" class="flag form-check-input" value="{{ $item->appmntSlot}}" checked>
                                                        @else
                                                            <input type="checkbox" id="flag" name="flag[]" class="flag form-check-input" value="{{ $item->appmntSlot }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="text" name="freecount[]" id="freecount" class="freecount form-control" value="{{ $item->appmntSlotMaxCount }}" placeholder="" onkeypress="return onlyNumberKey(event)" min="{{ $item->appmntSlotMaxCount-$item->appmntSlotFreeCount }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="booked[]" id="booked" value="{{ $item->appmntSlotMaxCount-$item->appmntSlotFreeCount }}" class="form-control" readonly="readonly">
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
                                    or <a href="/admin/appointment/{{ $docType }}/{{ $appointmentType }}/{{ $start_date }}/{{ $end_date }}/index">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="appointmentType" value="{{$appointmentType}}">
                            <input type="hidden" name="docType" value="{{$docType}}">
                            <input type="hidden" name="date" value="{{$date}}">
                        </form>
                    </div>
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
        // if("{{ $appointmentType }}" == "VED"){
        //     $("#max").val(1);
        // }else{
        //     $("#max").val(6);
        // }
        $("#manipulate-checkbox").on('change', function(){
            if($(this).val() === '1'){
                $(".flag").prop('checked', false);
            }
            if($(this).val() === '2'){
                $(".flag").prop('checked', true);
            }
        });
        $("#max").on('change', function(){
            // console.log($(this).val());
            if($(this).val() > 0 && $(this).val() <= 10){
                $(".freecount").val($(this).val());
            }else{
                alert('Please enter a value between 1 and 10');
            }
        });
    });
</script> 



@endsection