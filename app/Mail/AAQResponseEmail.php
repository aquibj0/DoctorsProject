<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AAQResponseEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $patient;
    public $srvcReq;
    public $asaq;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user.ask-doctor.response');
    }
}
