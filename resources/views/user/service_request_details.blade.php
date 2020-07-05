@extends('layouts.app')
@section('content')

    <section class="mt-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    {{ $serviceRequests }}
                    {{-- @if ()
                        
                    @endif --}}
                </div>
            </div>
        </div>
    </section>



@endsection