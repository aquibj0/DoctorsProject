<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;

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
        if($request){
            $msg = new ContactUs;
            $msg->name = $request->name;
            $msg->email = $request->email;
            $msg->phoneNo = $request->phone;
            // $msg->address = $request->address;
            $msg->topic = $request->subject;
            $msg->message = $request->message;
            $msg->save();



            // Mail::send('emails.company_signup_request',
            // array(
            //     'user_name' => $request->get('user_name'),
            //     'user_email' => $request->get('user_email'),
            //     'company_name' => $request->get('company_name'),
            //     'company_website' => $request->get('company_website'),
            //     'no_of_employee' => $request->get('no_of_employee')
            // ),
            // function($message){
            //     $message->to('aquib.jwd02@gmail.com', 'Admin')->subject('Company Sign Up | KiwisMedia');
            // });








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
