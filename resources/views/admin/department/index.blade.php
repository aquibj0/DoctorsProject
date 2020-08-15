@extends('admin.layouts.app')


@section('content')
    
    <section class="departments mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                        <div class="register-block">
                            <h2><b>DEPARTMENTS</b></h2>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                        <a href="#" data-toggle="modal" data-target="#createDepartment" class="btn btn-maroon btn-md float-right" >Add Department</a>
                </div>
                <div class="card-body">
                    @include('layouts.message')
                    <div class="row">
                        <div class="col-md-12">
                
                            @if (!empty($departments))
                                <table class="table  table-bordered">
                                    <thead class="thead-dark">
                                        <th scope="col">S No.</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($departments as $department)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$department->department_name}}</td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#{{ 'editDepartment'.$loop->iteration }}" class="btn btn-maroon btn-sm">Edit</a>

                                                    <!--Edit Department Modal -->
                                                    <div class="modal fade" id="{{ 'editDepartment'.$loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Department</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <form action="{{route('department.edit', $department->id)}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        {{-- department_name Input --}}
                                                                        <label for="department_name" class="maroon">Name of Department</label>
                                                                        <input type="text" class="form-control"class="form-control @error('department_name') is-invalid @enderror" id="department_name"  name="department_name" maxlength="40" value="{{$department->department_name}}">
                                                                        @error('department_name')
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



                                                    <a href="#" data-toggle="modal" data-target="#{{ 'deleteDepartment'.$loop->iteration }}" class="btn btn-maroon btn-sm">Delete</a>
                                                    <!--Delete Department Modal -->
                                                    <div class="modal fade" id="{{ 'deleteDepartment'.$loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Department</b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <form action="{{route('department.delete', $department->id)}}" method="post">
                                                                    @csrf
                                                                    
                                                                    <div class="modal-body">
                                                                        <h5 > Confirm Delete <b class="maroon">{{$department->department_name}} ?</b></h5>
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

                                                    


                                                        
                                                        
                                                     </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="maroon"><b>No Department</b></p>
                            @endif
                        </div>


                        <!--Create Department Modal -->
                        <div class="modal fade" id="createDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title maroon" id="exampleModalLongTitle"><b>Create Department</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{route('department.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{-- department_name Input --}}
                                            <label for="department_name" class="maroon">Name of Department</label>
                                            <input type="text" class="form-control"class="form-control @error('department_name') is-invalid @enderror" id="department_name" placeholder="department_name" name="department_name" value="{{ old('department_name') }}" maxlength="40" required>
                                            @error('department_name')
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


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection