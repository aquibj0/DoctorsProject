<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Controllers\Controller;
use App\ServiceRequest;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
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


    public function create_user(){
        return view('admin.auth.create-user');
    }

    public function store_user(Request $request){
        // return $request;
        $intUser = new Admin;
        $intUser->FirstName = $request->firstName;
        $intUser->LastName = $request->lastName;
        $intUser->phoneNo = $request->phoneNo;
        $intUser->category = $request->category;
        $intUser->department = $request->department;
        $intUser->email = $request->email;
        if($request->category == 'doc'){
            $intUser->salutation = 'Dr.';
        }else{
            $intUser->salutation = 'Mr./Ms.';
        }
        $intUser->password = Hash::make('password');
        $intUser->save();
        $intUser->intuId = "IID".$intUser->id;
        $intUser->update();
        return redirect('/admin/dashboard');
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
        $admins->password=bcrypt($request->password);

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
}