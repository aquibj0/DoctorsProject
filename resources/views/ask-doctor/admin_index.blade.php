@extends('layouts.app')
@section('content')

<section class="ask-doctor" style="padding-top:0">
    
    <div class="row">
        <div class="col-md-4" style="background:#142cd6; height:100vh;"></div>
        <div class="col-md-8" style=" height:100vh;">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ask-dcotor-form">
                        <div class="register-block">
                           <h2> Ask a doctor</h2>
                        </div>
                        @foreach($aaq as $item)
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">{{ $item->id }}</h5>
                              <h6 class="card-subtitle mb-2 text-muted">{{ $item->updated_at }}</h6>
                              <p class="card-text">
                                @foreach($srvcReq as $x)
                                @if($item->aaqSrId == $x->id)
                                {{ $item }}
                                <br>
                                <br>
                                {{ $x }}
                                @endif
                                @endforeach
                              </p>
                              <a href="{{ url('/doctor/ask-a-doctor/'.$item->id) }}" class="btn btn-primary btn-md">Card link</a>
                              {{-- <a href="#" class="card-link">Another link</a> --}}
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="">
                            
                            {{ $item }}
                            <br>
                            <br>
                            
                            
                        </div> --}}
                    </div>
                </div>
            </div>     
        
        </div>
    </div>


</section>




@endsection