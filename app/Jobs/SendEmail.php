<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\AAQEmail;
use Mail;
use Auth;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $patient;
    public $srvcReq;
    public $asaq;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($patient, $srvcReq, $asaq)
    {
        $this->patient = $patient;
        $this->srvcReq = $srvcReq;
        $this->asaq = $asaq;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->patient->patEmail){
            Mail::to(Auth::user()->userEmail)
                ->cc($this->patient->patEmail)
                ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq));
        }else{
            Mail::to(Auth::user()->userEmail)
                ->send(new AAQEmail($this->patient, $this->srvcReq ,$this->asaq));
        }
    }
}
