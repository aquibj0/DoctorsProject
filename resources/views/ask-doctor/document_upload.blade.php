@extends('layouts.app')
@section('content')



<div class="container">
    {{-- <h1><b>Uplaod Document</b></h1>
    {{$patient}}
    {{$asaq}}
    {{$srvcReq}} --}}


    <form action="/document-store" method="post">
        <div class="form-group">
            @csrf
            <input type="text" name="patient_id" id="patient_id" value="{{$patient->id}}"> 
        
            <br>
            <input type="text" name="patient_document" id="patient_document">
            <br>
            <input type="text" name="document_description" id="document_description">

            {{-- <input type="sumi" name="" id=""> --}}
            <button type="submit">Submit</button>

        </div>
    </form>

</div>

@endsection