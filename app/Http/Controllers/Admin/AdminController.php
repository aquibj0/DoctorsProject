<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\ServiceRequest;
use App\Department;
use App\PatientDocument;


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
    public function index()
    {
        $servReq = ServiceRequest::all();
        return view('admin.dashboard')->with('servReq', $servReq);
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

    // public function create_user(){
    //     $dept = Department::all()->pluck('id', 'department_name');
    //     return view('admin.auth.internal_user.create-user')->with('dept', $dept);
    // }

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
            $intUser = new Admin;
            $intUser->firstName = $request->firstName;
            $intUser->lastName = $request->lastName;
            $intUser->phoneNo = $request->phoneNo;
            $intUser->category = $request->category;
            $intUser->department = $request->department;
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
            $intUser->password = Hash::make('password');
            $intUser->save();
            $intUser->intuId = "IID".$intUser->id;
            $intUser->update();
            
            return redirect('/admin')->with('success', 'User created successfully!');
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