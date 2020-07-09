@extends('admin.layouts.app')

@section('content')

<div class="col-md-4 mt-4">
    <div class="form mt-4 mt-2">
        <form method="POST" action="{{ url('/admin/ask-a-doctor/'.$srvcReq->askQuestion->id.'/response') }}" >
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
                    {{-- <input type="file" class="form-control" > --}}
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width:100%">SUBMIT</button>
        </form>
    </div>
</div>

@endsection