<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Clinic;

class ClinicController extends Controller
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
        $clinic = Clinic::all();
        return view('admin.clinic.index')->with('clinics', $clinic);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clinic.create');
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
            'clinicName' => ['required', 'string', 'max:32'],
            'clinicMobileNo' => ['nullable', 'numeric', 'digits:10', 'unique:clinic'],
            'clinicLandLineNo' => ['nullable', 'numeric', 'digits:12', 'unique:clinic'],
            'clinicAddressLine1' => ['required', 'string', 'max:64'],
            'clinicAddressLine2' => ['max:64'],
            'clinicCity' => ['required', 'string', 'max:35'],
            'clinicDistrict' => ['nullable', 'string', 'max:35'],
            'clinicState' => ['required', 'string', 'max:35'],
            'clinicCountry' => ['required', 'string', 'max:35'],
            'clinicPincode' => ['required', 'numeric', 'digits:6']
        ]);
        if(!$validator->fails()){
            $clinic = new Clinic;
            $clinic->clinicName = $request->clinicName;
            $clinic->clinicMobileNo = $request->clinicMobileNo;
            $clinic->clinicLandLineNo = $request->clinicLandLineNo;
            $clinic->clinicAddressLine1 = $request->clinicAddressLine1;
            if($request->clinicAddressLine2)
                $clinic->clinicAddressLine2 = $request->clinicAddressLine2;
            $clinic->clinicCity = $request->clinicCity;
            $clinic->clinicDistrict = $request->clinicDistrict;
            $clinic->clinicState = $request->clinicState;
            $clinic->clinicCountry = $request->clinicCountry;
            $clinic->clinicPincode = $request->clinicPincode;
            $clinic->save();
            if($clinic->save()){
                
                return redirect('/admin/clinic')->with('success', 'Clinic added successfully!');
            }
            else{
                $clinic->delete();
                return redirect()->back()->with('error', 'Something went wrong!')->withInput();
            }
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
        return "store";
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
        $clinic = Clinic::find($id);
        // return $clinic;
        if(!empty($clinic)){
            return view('admin.clinic.edit')->with('clinic', $clinic);
        }else{
            return redirect('/admin/clinic')->with('error', 'Something Went Wrong!');
        }
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
        $clinic = Clinic::find($id);
        if(!empty($clinic)){
            $validator = Validator::make($request->all(), [
                'clinicName' => ['required', 'string', 'max:32'],
                'clinicMobileNo' => ['nullable', 'numeric', 'digits:10'],
                'clinicLandLineNo' => ['nullable', 'numeric'],
                'clinicAddressLine1' => ['required', 'string', 'max:64'],
                'clinicAddressLine2' => ['string', 'nullable', 'max:64'],
                'clinicCity' => ['required', 'string', 'max:35'],
                'clinicDistrict' => ['nullable', 'string', 'max:35'],
                'clinicState' => ['required', 'string', 'max:35'],
                'clinicCountry' => ['required', 'string', 'max:35'],
                'clinicPincode' => ['required', 'numeric', 'digits:6'],
            ]);
            if(!$validator->fails()){
                $clinic->clinicName = $request->clinicName;
                $clinic->clinicMobileNo = $request->clinicMobileNo;
                $clinic->clinicLandLineNo = $request->clinicLandLineNo;
                $clinic->clinicAddressLine1 = $request->clinicAddressLine1;
                if($request->clinicAddressLine2)
                    $clinic->clinicAddressLine2 = $request->clinicAddressLine2;
                $clinic->clinicCity = $request->clinicCity;
                $clinic->clinicDistrict = $request->clinicDistrict;
                $clinic->clinicState = $request->clinicState;
                $clinic->clinicCountry = $request->clinicCountry;
                $clinic->clinicPincode = $request->clinicPincode;
                $clinic->update();
                if($clinic->update()){
                    
                    return redirect('/admin/clinic')->with('success', 'Clinic added successfully!');
                }
                else{
                    // $clinic->delete();
                    return redirect()->back()->with('error', 'Something went wrong!')->withInput();
                }
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        // return $request; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinic = Clinic::find($id);
        if(!empty($clinic)){
            $clinic->delete();
            return redirect('/admin/clinic')->with('success', 'Clinic deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'Clinic dosen\'t exists!');
        }
    }
}
