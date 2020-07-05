@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Admin's</strong> Dashboard</div>

                <div class="panel-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach($servReq as $item)
                        <div class="card">
                        {{ $item }}
                        <br>
                        <a href="{{ url('/admin/service-request/'.$item->id) }}" class="btn btn-primary btn-sm">Open</a>
                        </div>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection