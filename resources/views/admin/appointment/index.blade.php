@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>Internal Users</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    {{-- <div class="row">
                        <div class="col-md"> --}}
                            <span style="float: right">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <a href="/admin/appointment/create/video" class="btn btn-maroon btn-md float-right">Add Video Appointment</a>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="/admin/appointment/create/clinic" class="btn btn-maroon btn-md float-right">Add Clinic Appointment</a>
                                    </div>
                                </div>
                            </span>
                        {{-- </div>
                    </div> --}}
                </div>
                <div class="card-body">
                    @if($appointments)
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right">{{--<a href="#">&#9650;</a><a href="#">&#9660;</a></span>--}}</th>
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
                                                            {{-- department_name Input --}}
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
                    </table>
                    @else
                        <h2>No User added!</h2>
                    @endif
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