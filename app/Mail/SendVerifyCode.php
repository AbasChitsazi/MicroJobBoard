<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendVerifyCode extends Mailable implements ShouldQueue
{


    use Queueable;

    public $name;
    public $email;
    public $hash;


    public function __construct($name, $email, $hash)
    {
        $this->name = $name;
        $this->email = $email;
        $this->hash = $hash;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')
            ->view('email.verify-email')
            ->with([
                'name' => $this->name,
                'email'    => $this->email,
                'hash'  => $this->hash
            ]);
    }
}
