<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\AAQEmail;
use App\Mail\AAQResponseEmail;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($patient, $srvcReq, $asaq, $user, $option)
    {
        $this->patient = $patient;
        $this->srvcReq = $srvcReq;
        $this->asaq = $asaq;
        $this->option = $option;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            
        if($this->option == 1){
            if($this->patient->patEmail){
                
                Mail::to(Auth::user()->userEmail)
                    ->cc($this->patient->patEmail)
                    ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq));
            }else{
                Mail::to(Auth::user()->userEmail)
                    ->subject("BIRTH - ".$this->srvcReq->service->srvcName." - Service Request Created")
                    ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq));
            }
        }else if($this->option == 2){
            if($this->patient->patEmail){
                Mail::to($this->user->userEmail)
                    ->cc($this->patient->patEmail)
                    ->send(new AAQResponseEmail($this->patient, $this->srvcReq ,$this->asaq));
            }else{
                Mail::to($this->user->userEmail)
                    ->send(new AAQResponseEmail($this->patient, $this->srvcReq ,$this->asaq));
            }
        }else{
            //
        }
    }
}
