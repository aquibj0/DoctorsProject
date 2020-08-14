<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Auth;
use Illuminate\Support\Facades\Validator;
class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->category == "admin"){
            $services = Service::orderBy('srvcName', 'ASC')->get();
            return view('admin.service.index',compact('services'));
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->category == "admin"){
            return view('admin.service.create');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'srvcName' => ['required', 'max:40'],
            'srvcShortName' => ['required', 'string', 'max:6'],
            'srvcPrice' =>['required', 'regex:/^\d*(\.\d{2})?$/'],
        ]);
        if(!$validator->fails()){
            $service = new Service;
            $service->srvcName = $request['srvcName'];
            $service->srvcShortName = $request['srvcShortName'];
            $service->srvcPrice = $request['srvcPrice'];
            // return $service;
            $service->save();
            return redirect()->route('service.home')->with('success', 'Service Added');
            // return redirect()->back()->with('success', 'Service Added');
        }
        else{
            return redirect()->back()->withInput()->withErrors($validator);
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
        if($request){
            $service = Service::find($id);
            $service->srvcName = $request['srvcName'];
            $service->srvcShortName = $request['srvcShortName'];
            $service->srvcPrice = $request['srvcPrice'];
            $service->save();
            return redirect()->back()->with('success', 'Service Added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->category == "admin"){
            Service::destroy($id);
            return redirect()->back()->with('success', 'Deleted');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
