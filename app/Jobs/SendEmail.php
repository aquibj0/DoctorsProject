<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\AAQEmail;
use App\Mail\AAQResponseEmail;
use App\Mail\AssignDoctorEmail;
use App\Mail\ServiceRequestReminderEmail;
use Mail;
use Auth;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $patient;
    public $srvcReq;
    public $asaq;
    public $option;
    public $user;
    public $payment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($patient, $srvcReq, $asaq, $payment, $user, $option)
    {
        $this->patient = $patient;
        $this->srvcReq = $srvcReq;
        $this->asaq = $asaq;
        $this->option = $option;
        $this->payment = $payment;
        $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->option == 1){             //service request creation and payment
            if($this->patient->patEmail){
                
                Mail::to(Auth::user()->userEmail)
                    ->cc($this->patient->patEmail)
                    ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq, $this->payment));
            }else{
                Mail::to(Auth::user()->userEmail)
                    ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq, $this->payment));
            }
        }elseif($this->option == 2){        //response from doctor
            if($this->patient->patEmail){
                Mail::to($this->user->userEmail)
                    ->cc($this->patient->patEmail)
                    ->send(new AAQResponseEmail($this->patient, $this->srvcReq ,$this->asaq));
            }else{
                Mail::to($this->user->userEmail)
                    ->send(new AAQResponseEmail($this->patient, $this->srvcReq ,$this->asaq));
            }
        }elseif($this->option == 3){        //Service request reminder 
            if($this->patient->patEmail){
                Mail::to($this->user->userEmail)
                    ->cc($this->patient->patEmail)
                    ->send(new ServiceRequestReminderEmail($this->patient, $this->srvcReq ,$this->asaq));
            }else{
                Mail::to($this->user->userEmail)
                    ->send(new ServiceRequestReminderEmail($this->patient, $this->srvcReq ,$this->asaq));
            }
        }elseif($this->option == 4){        //assign doctor
                Mail::to($this->user->email) //write relation for getting the assigned doctor so to directly getting the doctor id
                    ->send(new AssignDoctorEmail($this->patient, $this->srvcReq ,$this->asaq));
        }else{
            //
        }
    }
}
