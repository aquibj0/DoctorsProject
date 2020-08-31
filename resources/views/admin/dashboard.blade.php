@extends('admin.layouts.app')

@section('content')
<div class="">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        @if(Auth::user()->category == "doc")
                        <h2>BIRTH ECLINIC DASHBOARD - Dr. {{ Auth::user()->firstName.' '.Auth::user()->lastName }}</h2>
                        @else
                        <h2>BIRTH ECLINIC DASHBOARD</h2>
                        @endif
                    </div>
                </div>
            </div>
          

            <div class="card">
                @include('layouts.message')
               
                <div class="card-header">
                    <form action="/admin/filter" method="GET" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row form-group">
                            
                            <div class="col-md">
                            </div>
                            @if($start != 0  && $end != 0)
                                <div class="col-md" id="start_date" style="padding-top: 10px;">
                                    <input type="date" name="start_date" id="start-date" value="{{ $start }}" class="form-control">
                                </div>
                                <div class="col-md" id="end_date" style="padding-top: 10px;">
                                    <input type="date" name="end_date" id="end-date" value="{{ $end }}" onchange="clickSubmit()" class="form-control">
                                </div>
                            @else
                                <div class="col-md" id="start_date" style="padding-top: 10px;">
                                </div>
                                <div class="col-md" id="end_date" style="padding-top: 10px;">
                                </div>
                            @endif
                            <div class="col-md" style="padding-top: 10px;">
                            @if($filter)
                                <select name="filter" id="filter" class="form-control">
                                    <option value="0" selected>All</option>
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
                                    <option disabled>-Status-</option>
                                    @if($filter == "CLOSED")
                                        <option value="CLOSED" selected>CLOSED</option>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="NEW">NEW</option>
                                    @elseif($filter == "ACTIVE")
                                        <option value="CLOSED">CLOSED</option>
                                        <option value="ACTIVE" selected>ACTIVE</option>
                                        <option value="NEW">NEW</option>
                                    @elseif($filter == "NEW")
                                        <option value="CLOSED">CLOSED</option>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="NEW" selected>NEW</option>
                                    @else
                                        <option value="CLOSED">CLOSED</option>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="NEW">NEW</option>
                                    @endif
                                </select>
                            @else
                                <select name="filter" id="filter" class="form-control">
                                    <option value="0" selected>All</option>
                                    {{-- <option disabled>-Payment Status-</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Not Paid</option> --}}
                                    <option disabled>-Service Type-</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->srvcName }}</option>
                                    @endforeach
                                    <option disabled>-Others-</option>
                                    <option value="date">Date</option>
                                    <option disabled>-Status-</option>
                                    <option value="CLOSED">CLOSED</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="NEW">NEW</option>
                                </select>
                            @endif
                            </div>
                            <input type="submit" id="self_submit" style="display: none;">
                        </div>
                    </form>
                </div>
                
                <form action="/admin/operate" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body admin-db">
                            <div class="mb-2">
                                <p class="maroon location-hidden"><b>“Pan right or rotate screen to view all details”
                                </b></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead class="thead-dark">
                                        <tr>                                            
                                            @if(Auth::user()->category != "doc")
                                                <th scope="col">
                                                    <input type="checkbox" id="select_all"> 
                                                </th>
                                            @endif
                                            <th scope="col">
                                            
                                                SR No.
                                                <span style="float: right">
                                                    <a href="/admin/{{$filter}}/1/{{$start}}/{{$end}}">&#9650;</a>
                                                    <a href="/admin/{{$filter}}/2/{{$start}}/{{$end}}">&#9660;</a>
                                                </span>
                                                <script>
                                                    $(document).ready(function(){
                                                        $("#select_all").on('change', function(){
                                                            if($("#select_all").prop('checked') == true){
                                                                $(".select_id").prop('checked', true);
                                                            }else{
                                                                $(".select_id").prop('checked', false);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </th>
                                            <th scope="col">Sr Type</th>
                                            <th scope="col">Sr Date<span style="float: right"><a href="/admin/{{$filter}}/3/{{$start}}/{{$end}}">&#9650;</a><a href="/admin/{{$filter}}/4/{{$start}}/{{$end}}">&#9660;</a></span></th>
                                            <th scope="col">Sr Due Date<span style="float: right"><a href="/admin/{{$filter}}/5/{{$start}}/{{$end}}">&#9650;</a><a href="/admin/{{$filter}}/6/{{$start}}/{{$end}}">&#9660;</a></span></th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Service Status</th>
                                            @if(Auth::user()->category != "doc")
                                            <th scope="col">Assigned Doctor</th>
                                            @endif
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table">
                                        @if (count($servReq) > 0)
                                            @foreach ($servReq as $serviceReq)
                                                @if(Auth::user()->category == "doc")
                                                    @if($serviceReq->srAssignedIntUserId == Auth::user()->id)
                                                    <tr>
                                                        <th scope="row">{{$serviceReq->srId}}</th>
                                                        <td>{{$serviceReq->service->srvcName}}</td>
                                                        <td>{{date('d-m-Y H:i:s', strtotime($serviceReq->srRecievedDateTime))}}</td>
                                                        <td>{{ date('d-m-Y H:i:s', strtotime($serviceReq->srDueDateTime)) }}</td>
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
                                                            <a href="{{ url('/admin/service-request/'.$serviceReq->id) }}" class="btn btn-maroon btn-sm mb-2">View Details</a> 
                                                            @if ($serviceReq->paymentStatus == true)
                                                                @if (!isset($serviceReq->clinicAppointment))
                                                                    <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/respond') }}" class="btn btn-maroon btn-sm mb-2">Response</a>  
                                                                    <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/download-report') }}" class="btn btn-maroon btn-sm mb-2">Download Report</a>
                                                                @endif
                                                                                                          
                                                            @endif 
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @else
                                                <tr>
                                                    <td>
                                                        @if($serviceReq->paymentStatus == true && $serviceReq->srStatus != "CLOSED" && $serviceReq->srStatus != "Cancelled")
                                                            <input type="checkbox" class="select_id" name="srId[]" value="{{$serviceReq->id}}">
                                                        @else
                                                            <input type="checkbox" class="select_id_" name="srId[]" value="{{$serviceReq->id}}" disabled>
                                                        @endif
                                                    </td>
                                                    <th scope="row">
                                                        {{$serviceReq->srId}} </th>
                                                    <td>{{$serviceReq->service->srvcName}}</td>
                                                    <td>{{date('d-m-Y H:i:s', strtotime($serviceReq->srRecievedDateTime))}}</td>
                                                    <td>
                                                        {{ date('d-m-Y H:i:s', strtotime($serviceReq->srDueDateTime)) }}
                                                    </td>
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
                                                        @if(isset($serviceReq->adminDoctor))
                                                            {{ 'Dr. '.$serviceReq->adminDoctor->firstName.' '.$serviceReq->adminDoctor->lastName }}
                                                        @else
                                                            Not assigned.
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/admin/service-request/'.$serviceReq->id) }}" class="btn btn-maroon btn-sm mb-2">View Details</a> 
                                                        @if ($serviceReq->paymentStatus == true)
                                                            {{-- <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/respond') }}" style="border: 5px solid white" class="btn btn-maroon btn-sm">Response</a>   --}}
                                                            @if (!isset($serviceReq->clinicAppointment))
                                                                <a href="{{ url('/admin/service-request/'.$serviceReq->id.'/download-report') }}" class="btn btn-maroon btn-sm mb-2">Download Report</a>
                                                            @endif
                                                                                                      
                                                        @endif 
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <td colspan="10" class="text-center"><h2><b>No data available!</b></h2></td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="col-md"  style="padding-top: 10px;">
                            @if(Auth::user()->category != "doc")
                            <div class="row">
                                <div class="col-md">
                                    <select name="doctor" id="doctor" class="form-control">
                                        @if(count($doctors) > 0)
                                            <option disabled selected>Select Doctor</option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">Dr. {{ $doctor->firstName }} {{ $doctor->lastName }}</option>
                                            @endforeach
                                        @else
                                            <option selected disabled>No Doctos available</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md">
                                    @if(count($doctors) > 0)
                                        <button type="submit" name="admin_submit" value="assign_doctor" class="btn btn-md btn-maroon mb-4" style="width: 100%;">Assign Doctor</button>
                                        {{-- <input type="submit" class="btn btn-md btn-maroon" placeholder="Assign Doctor" style="width: 100%;"> --}}
                                    @else
                                        <button type="submit" name="admin_submit" class="btn btn-md btn-maroon mb-4" style="width: 100%;" disabled>Assign Doctor</button>
                                        {{-- <input type="submit" class="btn btn-md btn-maroon" placeholder="Assign Doctor" disabled style="width: 100%;"> --}}
                                    @endif
                                </div>
                                <div class="col-md">
                                    <button name="admin_submit" value="reminder" class="btn btn-md btn-maroon mb-4" style="width: 100%;">Reminder</button>
                                </div>
                                <div class="col-md">
                                    {{-- <button type="submit" name="admin_submit" value="HEY" class="btn btn-md btn-maroon mb-4" style="width: 100%;">HEY</button> --}}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
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