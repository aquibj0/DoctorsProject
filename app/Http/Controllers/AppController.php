<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Auth;
use App\ServiceRequest;
use PDF;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function thank_you(){
        return view('ask-doctor.thank-you');
    }

    public function generateInvoice($id){ 
        $data = ServiceRequest::where('srId', $id)->first();
        $pdf = PDF::loadView('invoice', compact('data'));
        return $pdf->download('BIRTH-'.$data->srId.'.pdf');
        return view('invoice')->with('data', ServiceRequest::where('srId', $id)->first());
    }

    public function index()
    {
        // if(Auth::user()){
        //     if(Auth::user()->userType == 'A'){
        //         return view('admin.home');
        //     }
        // }
        $services = Service::all();
        return view('app.index', compact('services'));
        // return Auth::user()->id;
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
    public function store(Request $request)
    {
        //
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
