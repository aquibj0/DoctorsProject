<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Carbon\Carbon;
use App\AppointmentSchedule;
use App\ServiceRequest;
use App\VideoCall;
use Illuminate\Support\Facades\Validator;


class VideoConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $patient = Patient::find($id);
        $slot = AppointmentSchedule::where('appmntSlotFreeCount','>', 0)->get();
        if($patient)
            return view('VideoConsultation.index')->with('patient', $patient)->with('slot', $slot);
        else
            return view('VideoConsultation.index')->with('patient', null)->with('slot', $slot);
    }

    public function getSlots($date, $appType){
        // if(request()->ajax()){
            $slot = AppointmentSchedule::where('appmntDate', '=',  $date)
                    ->where('appmntType', $appType)
                    ->where('appmntSlotFreeCount', '>', 0)->pluck('id', 'appmntSlot');
            // return response()->json($slot);
            return $slot;
        // }
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
        if($request->patient_id){
            $validator = Validator::make($request->all(), [
                // 'patient_id' => ['required', 'string', 'max:40'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentType' => ['required', 'min:3', 'max:3'],
                'slot' => ['required']
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if(!$validator->fails()){
                // if()
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }else{
            $validator = Validator::make($request->all(),[
                'firstName' => ['required', 'string', 'max:35'],
                'lastName' => ['required', 'string', 'max:35'],
                'gender' => ['required', 'string'],
                'age' => ['required', 'numeric', 'min:10', 'max:90', 'digits:2'],
                'mobileCC' => ['required'],
                'patMobileNo' => ['required', 'digits:10', 'unique:patient'],
                'patEmail' => ['required', 'string', 'unique:patient'],
                'addressLine1' => ['required', 'string', 'max:64'],
                'addressLine2' => ['string', 'max:64'],
                'city' => ['required', 'string', 'max:35'],
                'district' => ['required', 'string', 'max:35'],
                'state' => ['required', 'string', 'max:35'],
                'country' => ['required', 'string', 'max:35'],
                'department' => ['required'],
                'date' => ['required'],
                'appointmentType' => ['required', 'min:3', 'max:3'],
                'slot' => ['required']
            ]);
            if(!$validator->fails()){
                // if()
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
            }
        }
        return $request;
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
