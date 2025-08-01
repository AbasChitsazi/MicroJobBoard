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
    public $code;


    public function __construct($name, $code)
    {
        $this->name = $name;
        $this->code = $code;

    }

    public function build()
    {
        return $this->subject('Verify Your Email')
                    ->view('email.verify-email')
                    ->with([
                        'name' => $this->name,
                        'code'    => $this->code,
                    ]);
    }
}
