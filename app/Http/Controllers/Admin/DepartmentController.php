<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use Auth;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
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
            $departments = Department::orderBy('department_name', 'ASC')->get();
            return view('admin.department.index', compact('departments'));
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

        $validator = Validator::make($request->all(), [
            'department_name' => ['required', 'string', 'max:40'],
        ]);
        if(!$validator->fails()){
            $department = new Department;
            $department->department_name = $request['department_name'];
            $department->save();
            return redirect()->back()->with('success', 'Department Added');
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
        if(Auth::user()->category == "admin"){
            return view('admin.department.create');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
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
            $department = Department::find($id);
            $department->department_name = $request['department_name'];
            $department->update();
            return redirect()->back()->with('success', 'Department Edited');
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

            $department = Department::find($id);
            if(!empty($department)){
                if ($department->serviceRequests()->exists())
                    return redirect()->back()->with('error', 'Can not delete '.$department->department_name);
                else
                    $department->delete();
                    return redirect()->back()->with('success', 'Department Deleted');
                
            }else{
                return redirect()->back()->with('error', 'Department dosen\'t exists!');
            }





            // Department::destroy($id);
           
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
