@extends('admin.layouts.app')


@section('content')
    
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="register-block mt-4">
                        <h2><b>SERVICES</b></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @include('layouts.message')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right mb-3">
                                <a href="#" data-toggle="modal" data-target="#createService" class="btn btn-maroon btn-sm" >Add Service</a>
                            </div>
                            <table class="table table-responsive table-bordered">
                                <thead class="thead-dark">
                                    <th scope="col">S.No</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Service Short Name</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <tbody>
                                    @if (isset($services))
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$service->srvcName}}</td>
                                                <td>{{$service->srvcShortName}}</td>
                                                <td>{{$service->srvcPrice}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-maroon btn-sm">Edit</a>
                                                    <a href="#" class="btn btn-maroon btn-sm">Delete</a>

                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>


                            <!--Create Department Modal -->
                            <div class="modal fade" id="createService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Service</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    {{-- department_name Input --}}
                                                    <label for="srvcName" class="maroon">Name of Service</label>
                                                    <input type="text" class="form-control"class="form-control @error('srvcName') is-invalid @enderror" id="srvcName" placeholder="srvcName" name="srvcName" value="{{ old('srvcName') }}" maxlength="40" required>
                                                    @error('srvcName')                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    {{-- department_name Input --}}
                                                    <label for="srvcShortName" class="maroon">Name of Service</label>
                                                    <input type="text" class="form-control"class="form-control @error('srvcShortName') is-invalid @enderror" id="srvcShortName" placeholder="srvcShortName" name="srvcShortName" value="{{ old('srvcShortName') }}" maxlength="10" required>
                                                    @error('srvcShortName')                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    {{-- department_name Input --}}
                                                    <label for="srvcPrice" class="maroon">Name of Service</label>
                                                    <input type="text" class="form-control"class="form-control @error('srvcPrice') is-invalid @enderror" id="srvcPrice" placeholder="srvcPrice" name="srvcPrice" value="{{ old('srvcPrice') }}" required>
                                                    @error('srvcPrice')                                                        <span class="invalid-feedback" role="alert">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection