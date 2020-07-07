@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                {{-- <div class="card-header">Dashboard</div> --}}

                <div class="body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 style="text-align: center; " class="display-3"><b>Terms and Condition</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
