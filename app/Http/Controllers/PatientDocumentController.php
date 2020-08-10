<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PatientDocument;
use App\ServiceRequest;
use Illuminate\Support\Facades\Storage;

class PatientDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id){

        $serviceReq = ServiceRequest::where('id', $id)->first();
        if($request){
            $patientDocument = new PatientDocument;
            $patientDocument->documentType = $request['documentType'];
            $patientDocument->documentDescription = $request['documentDescription'];

            if($request->hasFile('documentFileName')){
                //Get filename with extension
                $fileNameWithExt = $request->file('documentFileName')->getCLientOriginalName();
                // Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('documentFileName')->getClientOriginalExtension();
                //File name to Store
                $fileNameToStore = $serviceReq->srId.'-'.$filename.'.'.$extension;
                //Upload File
                $path = $request->file('documentFileName')->storeAs('public/documentFileName', $fileNameToStore);
            }
            else{
                $fileNameToStore = 'nofile.img';
            }
            if($request['documentDate'])
                $patientDocument->documentDate = $request['documentDate'];
            else
                $patientDocument->documentDate = Carbon::now()->toDateString();
            $patientDocument->documentUploadDate = Carbon::now()->toDateString(); 
            $patientDocument->documentUploadedBy = $request['documentUploadedBy'];
            $patientDocument->service_request_id = $request['service_request_id'];
            $patientDocument->documentFileName = $fileNameToStore;
            $patientDocument->save();
            return redirect()->back()->with('success', 'Document Uploaded');

        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    

    //  Function to delete Document
    public function destroy($id)
    {
        PatientDocument::destroy($id);
        return redirect()->back()->with('success', 'Deleted');
    }


    // Download Reports
    public function downloadFile($id){
        $document = PatientDocument::findOrFail($id);
        // $url = public_path().'\storage\\'.$document->documentFileName;
        // $url = 'documentFileName\\'.$document->documentFileName;
        return response()->download(storage_path('app/public/documentFileName/'.$document->documentFileName));
        // return Response::download(storage_path('app/public/documentFileName/'.$document->documentFileName), )
        // return Storage::disk('local_public')->get($url);
    }
}
