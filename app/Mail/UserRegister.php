<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;
    public $username , $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $username , $password)
    {
        $this->username=$username;  $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email=$this->username;
        $password=$this->password;
        return $this->view('mail.user-register',compact('email','password'));
    }
}
