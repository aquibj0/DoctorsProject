@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="register-block">
                <h2><b>DOWNLOAD REPORTS</b></h2>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="maroon mb-2"><b><u>PATIENT DETAILS</u></b></h5>
                    <div class="table-responsive">
                        <table class="table  table-bordered">
                            <thead class="thead-dark">
                                <th scope="col">Service Req ID</th>
                                <th scope="col">Patient ID</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Patient Age</th>
                                <th scope="col">Patient Gender</th>
                                

                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$srvcReq->srId}}</td>
                                    <td>{{$srvcReq->patient->patId}}</td>
                                    <td>{{$srvcReq->patient->patFirstName}} {{$srvcReq->patient->patLastName}}</td>
                                    <td>{{ $srvcReq->patient->patAge}}</td> 
                                    <td>{{ $srvcReq->patient->patGender }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                

                    <br>
                    <h5 class="maroon mb-2"><b><u>PATIENT'S PRESCRIPTION</u></b></h5>

                    <div class="table-responsive">
                        <table class="table  table-bordered" style="max-width:100%; overflow-x:scroll;">
                            <thead class="thead-dark">
                                <th scope="col">Document Type </th>
                                <th scope="col">File Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Uploaded On</th>
                                <th scope="col">Action</th>



                            </thead>

                            <tbody>
                                @foreach ($patDocs as $patDoc)
                                    <tr>
                                        <td>{{$patDoc->documentType}}</td>
                                        <td>{{$patDoc->documentFileName}}</td>
                                        <td>{{$patDoc->documentDescription}}</td>
                                        <td>Uploaded</td>
                                        <td>{{$patDoc->documentUploadDate}}</td>
                                        <td><a href="{{url('downloadDoc/'.$patDoc->id)}}" class="btn btn-maroon btn-sm">Download</a></td>
                                    </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="container">
                        *Instructions for Downloading Reports <br>
                        1. Download files uploaded by customer for a booking ID <br>
                        2. Download names will be prefixed with an order ID <br>
                        3. Once downloaded files will have read only access <br>
                    </div>
                    {{-- {{$srvcReq}} --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 mt-4">
    <div class="form mt-4 mt-2">
        

       
        {{-- <form method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
            {{ csrf_field() }}

            <div class="form-row mt-1">
                <div class="form-group col-md-12">
                    <textarea class="form-control" name="response" id="response" cols="30" rows="5" placeholder="Response"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <h5 class="maroon MB-3"><b>UPLOAD PRESCRIPTION</b></h5>
                </div>
                <div class="form-group col-md-12">
                    <span><h5>Do you want to upload?</h5>
                    <input type="checkbox" value="1" name="document_upload" id="document_upload" placeholder="Yes"><label for="document_upload">YES</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" value="0" name="document_upload" id="document_upload" placeholder="No"><label for="document_upload">NO</label>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width:100%">SUBMIT</button>
        </form> --}}
    </div>
</div>

@endsection