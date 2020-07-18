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
                                        <button type="button" class="btn btn-maroon" data-toggle="modal" data-target="#exampleModalCenter">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    Editing Form
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                         
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
@endsection