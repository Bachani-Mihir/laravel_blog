<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $reset_link = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset_link){
        $this->reset_link = $reset_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('emails.forget_password',['reset_link' => $this->reset_link])->subject('Reset Your Password');
    }
}
