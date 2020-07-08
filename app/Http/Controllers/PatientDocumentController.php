<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PatientDocument;
use App\ServiceRequest;
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

            // if($request->hasFile('documentFileName')) {
            //     //get filename with extension
            //     $filenamewithextension = $request->file('documentFileName')->getClientOriginalName();
         
            //     //get filename without extension
            //     $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
         
            //     //get file extension
            //     $extension = $request->file('documentFileName')->getClientOriginalExtension();
         
            //     //filename to store
            //     $filenametostore = $filename.'_'.time().'.'.$extension;
         
            //     //Upload File
            //     $request->file('documentFileName')->storeAs('public', $filenametostore);

            // }
            if($request->hasFile('documentFileName')){
                $patientDocument->documentFileName= $request->file('documentFileName')->store('documentFileName','public');
            }
            $patientDocument->documentDate = $request['documentDate'];
            $patientDocument->documentUploadDate = Carbon::now()->toDateString(); 
            $patientDocument->documentUploadedBy = $request['documentUploadedBy'];
            $patientDocument->service_request_id = $request['service_request_id'];
            $patientDocument->save();
            // return $request;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
