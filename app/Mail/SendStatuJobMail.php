<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class SendStatuJobMail extends Mailable implements ShouldQueue
{
    use Queueable;

    public $status;
    public $job;
    public $name;

    public function __construct($status, $job, $name)
    {
        $this->status = $status;
        $this->job = $job;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Job Application Status')
                    ->view('email.send-job-status')
                    ->with([
                        'status' => $this->status,
                        'job'    => $this->job,
                        'name'   => $this->name,
                    ]);
    }
}
