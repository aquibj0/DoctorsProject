@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block">
                        <h2>admin Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <div class="row">
                        <div class="col-md">
                            <div class="date-range">

                            </div>
                            <span style="float: right">
                                <select name="filter" id="filter" class="form-control">
                                    <option disabled selected>Filters</option>
                                    <option disabled>-Payment Status-</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Not Paid</option>
                                    <option disabled>-Service Type-</option>
                                    <option value="AAQ">Ask A Question</option>
                                    <option value="VED">Video call with Expert Doctor</option>
                                    <option value="VTD">Video call with Team Doctor</option>
                                    <option value="CLI">Clinic Appointment</option>
                                    <option disabled>-Others-</option>
                                    <option value="date">Date</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Sr Type<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">Sr Date<span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
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
                                            <input type="checkbox">
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
                </div>
            </div>
        </div>
    </div>

    {{-- <input type="date" name="start-date" id="start-date" class="form-control">
    <input type="date" name="end-date" id="end-date" class="form-control">
 --}}


</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //date change

        $('#filter').on('change', function(){
            // var appType = $(this).val();
            var filter = $(this).val();
            // console.log(appType);
            console.log(filter);
            // $('#slot').find('option').not(':first').remove();
            if(filter != "date"){
                $.ajax({
                    url: '/query/'+filter,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#table').empty();
                        $.each(data, function(srId, ) )
                    },
                    error: function(){
                        console.log('error');
                    }
                });
            }else{
                console.log("date section");
                var html = '<input type="date" name="start-date" id="start-date" class="form-control">';
                html += '<input type="date" name="end-date" id="end-date" class="form-control">';
                $('#date-range').append(html);
            }
        });
    });
</script> --}}
@endsection