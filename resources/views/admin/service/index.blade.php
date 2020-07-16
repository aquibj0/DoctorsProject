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
                <div class="card-header ">
                    <a href="/admin/services/create"  class="float-right btn btn-maroon btn-md" >Add Service</a>
                </div>
                <div class="card-body">
                    @include('layouts.message')
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class=" mb-3">
                            </div> --}}
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
                                                    {{-- Edit Serive --}}
                                                    <a href="#" data-toggle="modal" data-target="#{{ 'editService'.$loop->iteration }}" class="btn btn-maroon btn-sm">Edit</a>
                                                    <!--Edit Department Modal -->
                                                    <div class="modal fade" id="{{ 'editService'.$loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Department</b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <form action="{{route('service.edit', $service->id)}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            {{-- department_name Input --}}
                                                                            <label for="srvcName" class="maroon">Name of Service</label>
                                                                            <input type="text" class="form-control @error('srvcName') is-invalid @enderror" id="srvcName" placeholder="srvcName" name="srvcName" value="{{ $service->srvcName }}" maxlength="40" required>
                                                                            @error('srvcName')                                                        <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            {{-- department_name Input --}}
                                                                            <label for="srvcShortName" class="maroon">Name of Service</label>
                                                                            <input type="text" class="form-control @error('srvcShortName') is-invalid @enderror" id="srvcShortName" placeholder="srvcShortName" name="srvcShortName" value="{{ $service->srvcShortName }}" maxlength="6" required>
                                                                            @error('srvcShortName')                                                        <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            {{-- department_name Input --}}
                                                                            <label for="srvcPrice" class="maroon">Name of Service</label>
                                                                            <input type="text" class="form-control @error('srvcPrice') is-invalid @enderror" id="srvcPrice" placeholder="srvcPrice" name="srvcPrice" value="{{ $service->srvcPrice }}" required>
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
                                                    

                                                    {{-- Delete Service --}}
                                                    <a href="#" data-toggle="modal" data-target="#{{ 'deleteService'.$loop->iteration }}" class="btn btn-danger btn-sm">Delete</a>
                                                    
                                                    <div class="modal fade" id="{{ 'deleteService'.$loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Department</b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <form action="{{route('service.delete', $service->id)}}" method="post">
                                                                    @csrf
                                                                    
                                                                    <div class="modal-body">
                                                                        <h5 > Confirm Delete <b class="maroon">{{$service->srvcName}} ?</b></h5>
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


                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>


                            <!--Create Service Modal -->
                            {{-- <div class="modal fade" id="createService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Service</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection