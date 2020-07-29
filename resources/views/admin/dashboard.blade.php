@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>BIRTH ECLINIC DASHBOARD</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <form action="/admin/filter" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row form-group">
                            <div class="col-md">
                            </div>
                            <div class="col-md">
                            </div>
                            @if($start != 0  && $end != 0)
                                <div class="col-md" id="start_date">
                                    <input type="date" name="start_date" id="start-date" value="{{ $start }}" class="form-control">
                                </div>
                                <div class="col-md" id="end_date">
                                    <input type="date" name="end_date" id="end-date" value="{{ $end }}" onchange="clickSubmit()" class="form-control">
                                </div>
                            @else
                                <div class="col-md" id="start_date">
                                </div>
                                <div class="col-md" id="end_date">
                                </div>
                            @endif
                            <div class="col-md">
                            @if($filter)
                                <select name="filter" id="filter" class="form-control">
                                    <option value="0" selected>No Filter</option>
                                    {{-- <option disabled>-Payment Status-</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Not Paid</option> --}}
                                    <option disabled>-Service Type-</option>
                                    @foreach($services as $service)
                                        @if($filter == $service->id)
                                            <option value="{{ $service->id }}" selected>{{ $service->srvcName }}</option>
                                        @else
                                            <option value="{{ $service->id }}">{{ $service->srvcName }}</option>
                                        @endif
                                    @endforeach
                                    <option disabled>-Others-</option>
                                    @if($filter == "date")
                                        <option value="date" selected>Date</option>
                                    @else
                                        <option value="date">Date</option>
                                    @endif
                                </select>
                            @else
                                <select name="filter" id="filter" class="form-control">
                                    <option disabled selected>Filter By</option>
                                    {{-- <option disabled>-Payment Status-</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Not Paid</option> --}}
                                    <option disabled>-Service Type-</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->srvcName }}</option>
                                    @endforeach
                                    <option disabled>-Others-</option>
                                    <option value="date">Date</option>
                                </select>
                            @endif
                            </div>
                            <input type="submit" id="self_submit" style="display: none;">
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form action="/admin/assign/doctor" method="POST" enctype="multipart/form-data">
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><input type="checkbox" id="select_all">SR No. <span style="float: right"><a href="/admin/{{$filter}}/1/{{$start}}/{{$end}}">&#9650;</a><a href="/admin/{{$filter}}/2/{{$start}}/{{$end}}">&#9660;</a></span></th>
                                    <th scope="col">Sr Type</th>
                                    <th scope="col">Sr Date<span style="float: right"><a href="/admin/{{$filter}}/3/{{$start}}/{{$end}}">&#9650;</a><a href="/admin/{{$filter}}/4/{{$start}}/{{$end}}">&#9660;</a></span></th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Service Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                @if (!empty($servReq))
                                    @foreach ($servReq as $serviceReq)
                                        <tr>
                                            <th scope="row">
                                                <input type="checkbox" class="select_id" name="srId[]" value="{{$serviceReq->id}}">
                                                {{$serviceReq->srId}} </th>
                                            <td>{{$serviceReq->service->srvcName}}</td>
                                            <td>{{date('d-m-Y H:i:s', strtotime($serviceReq->srRecievedDateTime))}}</td>
                                            <td> 
                                                @if ($serviceReq->paymentStatus == true)
                                                Paid
                                                @else
                                                Not Paid
                                                @endif
                                            </td>
                                            <td>{{$serviceReq->patient->patFirstName}} {{$serviceReq->patient->patLastName}}</td>
                                            <td>{{$serviceReq->srStatus}}</td>
                                            <td>
                                                <a href="{{ url('/admin/service-request/'.$serviceReq->id) }}" class="btn btn-maroon btn-sm">View Details</a> 
                                                @if ($serviceReq->paymentStatus == true)
                                                    <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/respond') }}" class="btn btn-maroon btn-sm">Response</a>  
                                                    <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/download-report') }}" class="btn btn-maroon btn-sm">Download Report</a>                                          
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{-- <div class="container">
                            <div class="row">
                                <div class="col-md">
                                    <select name="doctor" id="doctor" class="form-control">
                                        <option disabled selected>Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md">
                                    
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#filter').on('change', function(){
            console.log($(this).val());
            
            if($(this).val() == "date"){
                $("#start_date").append('<input type="date" name="start_date" id="start_date_input" class="form-control">');
                $("#end_date").append('<input type="date" name="end_date" id="end_date_input" class="form-control" onchange="clickSubmit()">'); 
            }else{
                $("#start_date").empty();
                $("#end_date").empty();
                    $("#self_submit").click();
            }
        });
    });
    function clickSubmit(){
        document.getElementById('self_submit').click();
    }
</script>
@endsection