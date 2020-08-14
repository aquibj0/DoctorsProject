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
                    <div class="row">
                        
                        <div class="col-md">
                            <span style="float: right; margin-right: -1.3%;">
                                <a href="/admin/create/internal-user" class="btn btn-sm btn-maroon">Add new User</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($users)
                    <div class=" mb-2">
                        <p class="maroon location-hidden"><b>“Pan right or rotate screen to view all details”
                        </b></p>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SR No. <span style="float: right"><a href="#">&#9650;</a><a href="#">&#9660;</a></span></th>
                                <th scope="col">User Name</th>
                                {{-- <th scope="col">User Gender</th> --}}
                                {{-- <th scope="col">User Degree</th> --}}
                                <th scope="col">User Category</th>
                                {{-- <th scope="col">User Department</th> --}}
                                <th scope="col">User Email</th>
                                <th scope="col">User Mobile & ALternative</th>
                                {{-- <th scope="col">User Address</th> --}}
                                {{-- <th scope="col"></th> --}}
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->salutation }} {{ $user->firstName }} {{ $user->lastName }}</td>
                                    {{-- <td>{{ $user->degree }}</td> --}}
                                    <td>
                                        @if($user->category == "admin")
                                        ADMIN
                                        @elseif($user->category == "doc")
                                        DOCTOR
                                        @else
                                        OTHERS
                                        @endif
                                    </td>
                                    {{-- <td>{{ $user->department }}</td> --}}
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phoneNo }} 
                                        @if($user->alternatePhoneNo)
                                            & {{ $user->alternatePhoneNo }}
                                        @endif
                                    </td>
                                    {{-- <td>{{ $user->addressLine1 }},
                                        @if($user->addressLine2)
                                            {{ $user->addressLine2 }},
                                        @endif
                                        <br>
                                        {{ $user->city }}, {{ $user->district }},
                                        <br>
                                        {{ $user->state }}, {{ $user->country }}
                                    </td> --}}
                                    <td><a href="{{ url('/admin/internal-user/'.$user->id.'/delete') }}" class="btn btn-maroon btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
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