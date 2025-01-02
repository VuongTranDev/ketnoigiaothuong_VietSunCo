<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BackupNotificationMail extends Mailable
{
    use SerializesModels;

    public $status;
    public $details;

    public function __construct($status, $details)
    {
        $this->status = $status;
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Database Backup Status')
                    ->view('emails.backup');
    }
}
