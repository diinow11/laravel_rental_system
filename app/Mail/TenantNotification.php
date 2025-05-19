<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageBody;
    public $subjectLine;

    public function __construct(public $subject, public $body) {}

public function build()
{
    return $this->subject($this->subject)
                ->view('emails.tenant_notification') // this file must exist
                ->with(['body' => $this->body]);
}
}
