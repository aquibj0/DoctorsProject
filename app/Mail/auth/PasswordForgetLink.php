<?php

namespace App\Mail\auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordForgetLink extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("BIRTH - Request for Forgotten Password")->view('mail.auth.password_reset');
    }
}
