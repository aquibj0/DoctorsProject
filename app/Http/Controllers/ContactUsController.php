<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ContactUsMail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact-us');
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
        // return $request;
        if($request){
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:60'],
                'email' => ['required', 'email', 'max:70'],
                // 'userEmail' => ['string', 'email', 'max:100', 'unique:users'],
                'phone' => ['required', 'numeric',  'digits:10'],
                'address'  => ['sometimes', 'string', 'nullable', 'max:90'],
                'subject' => ['required', 'string', 'max:191'],
                'message' => ['required', 'string', 'max:255']
            ]);
            if($validator->fails()){
                 return redirect()->back()->withInput()->withErrors($validator);
            }else{
                DB::beginTransaction();
                try{
                    $msg = new ContactUs;
                    $msg->name = $request->name;
                    $msg->email = $request->email;
                    $msg->phoneNo = $request->phone;
                    $msg->address = $request->address;
                    $msg->topic = $request->subject;
                    $msg->message = $request->message;
                    $msg->save();
                    Mail::to('admin@admin.com')->send(new ContactUsMail($msg));
                }catch(\Exception $e){
                    DB::rollback();
                    return redirect()->back()->with('error','Something went wrong');
                }
                DB::commit();
            }
            return redirect('/contact-us')->with('success', $msg->name.', you message submitted successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
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
