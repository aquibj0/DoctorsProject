<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tzsk\Sms\Facade\Sms;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\ServiceRequest;
use App\Department;
use App\PatientDocument;
use Mail;
use App\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\auth\InternalUserRegisterEmail;
use App\Jobs\SendEmail;


class AdminController extends Controller
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

    public function random_strings($length_of_string) 
    { 
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    
        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result), 0, $length_of_string); 
    } 

    public function index()
    {
        $servReq = ServiceRequest::all();
        return view('admin.dashboard')->with('servReq', $servReq)->with('doctors', Admin::where('category', 'doc')->get())->with('start', 0)->with('end', 0)->with('filter', 0)->with('services', Service::all())->with('counter', 0);
    }

    public function filter(Request $request){
        if($request->filter == "date"){
            return view('admin.dashboard')->with('servReq', ServiceRequest::whereBetween('created_at', [Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00",Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59"])->get())->with('doctors', Admin::where('category', 'doc')->get())->with('filter', $request->filter)->with('services', Service::all())->with('counter', 1)->with('start', $request->start_date)->with('end', $request->end_date);
        }else if($request->filter >= 1 && $request->filter <= 5/*Service::latest()->first()->id*/){
            return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $request->filter)->get())->with('filter', $request->filter)->with('services', Service::all())->with('doctors', Admin::where('category', 'doc')->get())->with('counter', 1)->with('start', 0)->with('end', 0);
        }else if($request->filter == "CLOSED" || $request->filter == "ACTIVE" || $request->filter == "NEW"){
            return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $request->filter)->get())->with('filter', $request->filter)->with('services', Service::all())->with('doctors', Admin::where('category', 'doc')->get())->with('counter', 1)->with('start', 0)->with('end', 0);
        }
        else{
            return view('admin.dashboard')->with('servReq', ServiceRequest::all())->with('filter', $request->filter)->with('services', Service::all())->with('doctors', Admin::where('category', 'doc')->get())->with('counter', 1)->with('start', 0)->with('end', 0);
        }
    }

    public function sort($filter, $sort, $start=0, $end=0){
        if($filter == "date"){
            if($sort == 1){
                return view('admin.dashboard')->with('servReq', ServiceRequest::whereBetween('created_at', [Carbon::parse($start)->format('Y-m-d')." 00:00:00",Carbon::parse($end)->format('Y-m-d')." 23:59:59"])->orderBy('srId', 'desc')->get())->with('doctors', Admin::where('category', 'doc')->get())->with('filter', $filter)->with('services', Service::all())->with('counter', 0)->with('start', $start)->with('end', $end);
            }else if($sort == 2){
                return view('admin.dashboard')->with('servReq', ServiceRequest::whereBetween('created_at', [Carbon::parse($start)->format('Y-m-d')." 00:00:00",Carbon::parse($end)->format('Y-m-d')." 23:59:59"])->orderBy('srId', 'asc')->get())->with('doctors', Admin::where('category', 'doc')->get())->with('filter', $filter)->with('services', Service::all())->with('counter', 0)->with('start', $start)->with('end', $end);
            }else if($sort == 3){
                return view('admin.dashboard')->with('servReq', ServiceRequest::whereBetween('created_at', [Carbon::parse($start)->format('Y-m-d')." 00:00:00",Carbon::parse($end)->format('Y-m-d')." 23:59:59"])->latest('created_at')->get())->with('doctors', Admin::where('category', 'doc')->get())->with('filter', $filter)->with('services', Service::all())->with('counter', 0)->with('start', $start)->with('end', $end);
            }else if($sort == 4){
                return view('admin.dashboard')->with('servReq', ServiceRequest::whereBetween('created_at', [Carbon::parse($start)->format('Y-m-d')." 00:00:00",Carbon::parse($end)->format('Y-m-d')." 23:59:59"])->oldest('created_at')->get())->with('doctors', Admin::where('category', 'doc')->get())->with('filter', $filter)->with('services', Service::all())->with('counter', 0)->with('start', $start)->with('end', $end);
            }else{
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->get())->with('filter', $filter)->with('services', Service::all())->with('counter', 0)->with('error', 'Wrong URL!')->with('start', $start)->with('end', $end);   
            }
        }else if($filter >= 1 && $filter <= Service::latest()->first()->id){
            if($sort == 1){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->orderBy('srId', 'desc')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 2){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->orderBy('srId', 'asc')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 3){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->latest('created_at')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 4){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->oldest('created_at')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else{
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('service_id', $filter)->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('error', 'Wrong URL!')->with('start', 0)->with('end', 0);   
            }
        }else if($filter == "CLOSED" || $filter == "ACTIVE" || $filter == "NEW"){
            if($sort == 1){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $filter)->orderBy('srId', 'desc')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 2){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $filter)->orderBy('srId', 'asc')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 3){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $filter)->latest('created_at')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 4){
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $filter)->oldest('created_at')->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else{
                return view('admin.dashboard')->with('servReq', ServiceRequest::where('srStatus', $filter)->get())->with('filter', $filter)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('error', 'Wrong URL!')->with('start', 0)->with('end', 0);   
            }
        }
        else{
            if($sort == 1){
                return view('admin.dashboard')->with('servReq', ServiceRequest::orderBy('srId', 'desc')->get())->with('filter', 0)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 2){
                return view('admin.dashboard')->with('servReq', ServiceRequest::orderBy('srId', 'asc')->get())->with('filter', 0)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 3){
                return view('admin.dashboard')->with('servReq', ServiceRequest::latest('created_at')->get())->with('filter', 0)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else if($sort == 4){
                return view('admin.dashboard')->with('servReq', ServiceRequest::oldest('created_at')->get())->with('filter', 0)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('start', 0)->with('end', 0);
            }else{
                return view('admin.dashboard')->with('servReq', ServiceRequest::get())->with('filter', 0)->with('doctors', Admin::where('category', 'doc')->get())->with('services', Service::all())->with('counter', 0)->with('error', 'Wrong URL!')->with('start', 0)->with('end', 0);   
            }
        }
    }

    public function create_user_index(){
        $users = Admin::all();
        return view('admin.internal-user.index')->with('users', $users);
    }

    public function create_user(){
        $dept = Department::all();
        return view('admin.internal-user.create')->with('depts', $dept);
        // return view('admin.auth.internal_user.index-user')->with('users', $users);
    }

    public function store_user(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:40'],
            'lastName' => ['required', 'string', 'max:40'],
            'email' => ['string', 'email', 'max:100', 'unique:admins'],
            'phoneNo' => ['required', 'min:10', 'max:10', 'unique:admins'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if(!$validator->fails()){
            DB::beginTransaction();
                try{
                    $intUser = new Admin;
                    $intUser->firstName = $request->firstName;
                    $intUser->lastName = $request->lastName;
                    $intUser->phoneNo = $request->phoneNo;
                    $intUser->category = $request->category;
                    $intUser->email = $request->email;
                    $intUser->gender = $request->gender;
                    if($request->category == 'doc'){
                        $intUser->salutation = 'Dr.';
                    }else{
                        if($request->gender == "Male"){
                            $intUser->salutation = 'Mr.';
                        }else{
                            $intUser->salutation = 'Ms./Mrs.';
                        }
                    }
                    $password = $this->random_strings(10);
                    $intUser->password = Hash::make($password);
                    $intUser->save();
                    $intUser->intuId = "IID".str_pad($intUser->id,10, "0", STR_PAD_LEFT);
                    $intUser->update();
                    Mail::to($intUser->email)->send(new InternalUserRegisterEmail($intUser, $password));
                    
                } catch(\Exception $e){
                    DB::rollback();
                    return redirect()->back()->with('error', 'Something went wrong!')->withInput();
                }
                DB::commit();
                return redirect('/admin/internal-user')->with('success', 'User created successfully!');
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }   
    }

    public function delete_user($id){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate the data
        $this->validate($request, [
          'name'          => 'required',
          'email'         => 'required',
          'password'      => 'required'

        ]);

        // store in the database
        $admins = new Admin;
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password=Hash::make($request->password);

        $admins->save();


        return redirect()->route('admin.auth.login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Auth::user();
        return view('admin.show')->with('user', Auth::user());  
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

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->userPassword))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->userPassword = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function updateProfile(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'firstName' => 'string|max:40',
            'lastName' => 'string|max:40',
            'phoneNo' => 'min:10|max:10',
            'alternatePhoneNo' => 'nullable|max:10|min:10|unique:admins',
            'degree' => 'nullable|max:191|string',
            'dob' => 'string|nullable|max:10',
            'addressLine1' => 'string|nullable|max:64',
            'addressLine2' => 'string|nullable|max:64',
            'city' => 'string|nullable|max:35',
            'district' => 'nullable|string|max:35',
            'state' => 'string|nullable|max:35',
            'country' => 'string|nullable|max:35',
        ]);
        DB::beginTransaction();
        try{
            $intUser = Auth::user();
            $intUser->firstName = $request->firstName;
            $intUser->lastName = $request->lastName;
            $intUser->phoneNo = $request->phoneNo;
            $intUser->alternatePhoneNo = $request->alternatePhoneNo;
            $intUser->degree = $request->degree;
            $intUser->dob = Carbon::parse($request->dob)->toDateString();
            $intUser->addressLine1 = $request->addressLine1;
            $intUser->addressLine2 = $request->addressLine2;
            $intUser->city = $request->city;
            $intUser->district = $request->district;
            $intUser->state = $request->state;
            $intUser->country = $request->country;
            $intUser->update();
            // Mail::to($intUser->email)->send(new InternalUserRegisterEmail($intUser, $password));
            
        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Profile Updated successfully!');
    }



    public function updateImage(Request $request, $id){

        $user = Auth::user()->where('id', $id)->first();
        if($request){
            // return $request;
            if($request->hasFile('display_image')){
                $user->display_image = $request->file('display_image')->store('display_image','public');
            }
            $user->update();
            return redirect()->back()->with('success', 'Image successfull Uploaded');
        }
    }

    public function operate(Request $request){
        // return $request;
        if($request->admin_submit == 'assign_doctor'){
            if(count($request->srId) > 0){
                for($i = 0; $i < count($request->srId); $i++){
                    $srvcReq = ServiceRequest::where('id', $request->srId[$i])->first();
                    if($srvcReq){
                        if($srvcReq->srResponseDateTime < Carbon::now()){
                            DB::beginTransaction();
                            try{
                                $srvcReq->srAssignedIntUserId = $request->doctor;
                                $srvcReq->update();
                                $doctor = Admin::where('id', $request->doctor)->first();
                                SendEmail::dispatch($srvcReq->patient, $srvcReq, $srvcReq->askQuestion, null, $doctor, 4);
                            }catch(\Exception $e){
                                DB::rollback();
                                return redirect()->back()->with('error', 'Something went wrong! '.$e->getMessage());
                            }
                            DB::commit();
                        }else{
                            DB::rollback();
                            return redirect()->back()->with('error', 'Cannot assign doctor, as response time is over!');
                        }
                    }else{
                        DB::rollback();
                        return redirect()->back()->with('error', 'Service Request dosen\'t exists');
                    }
                }
                return redirect()->back()->with('success', 'Doctor assigned successfully!');
            }else{
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        }elseif($request->admin_submit == 'reminder'){
            for($i = 0; $i < count($request->srId); $i++){
                $srvcReq = ServiceRequest::where('id', $request->srId[$i])->first();
                $user = $srvcReq->user;
                if($srvcReq){
                    if($srvcReq->askQuestion){

                        Sms::send("Thank you. Your Service Request has been created with SR-ID  ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();
    
                        SendEmail::dispatch($srvcReq->patient, $srvcReq, $srvcReq->askQuestion, $srvcReq->payment, $srvcReq->user, 3);
                    }
                    elseif($srvcReq->videoCall){

                        Sms::send("Thank you. Your Service Request has been created with SR-ID  ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();
    
                        SendEmail::dispatch($srvcReq->patient, $srvcReq, $srvcReq->videoCall, $srvcReq->payment, $srvcReq->user, 3);
                    }
                    elseif($srvcReq->clinicAppointment){

                        Sms::send("Thank you. Your Service Request has been created with SR-ID  ".$srvcReq->srId)->to('91'.$user->userMobileNo)->dispatch();
    
                        SendEmail::dispatch($srvcReq->patient, $srvcReq, $srvcReq->clinicAppointment, $srvcReq->payment, $srvcReq->user, 3);
                    }
                }
            }
            return redirect()->back()->with('success', 'Reminder sent successfully!');
        }
    }

    public function respond($id){
        $srvcReq = ServiceRequest::where('id', $id)->first();
        return view('admin.respond', compact('srvcReq'));
    }

    public function downloadReport($id){
        $srvcReq = ServiceRequest::where('id', $id)->first();
        $patDocs = PatientDocument::where('service_request_id', '=', $srvcReq->id)->get();
        return view('admin.download-reports', compact('srvcReq', 'patDocs'));
    }
}