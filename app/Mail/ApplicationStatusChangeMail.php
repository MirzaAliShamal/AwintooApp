<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChangeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $restInfo;

    public function __construct($client, $restInfo)
    {
        $this->client = $client;
        $this->restInfo = $restInfo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Application Status has Changed'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.application_status_change',
            with: ['client' => $this->client, 'restInfo' => $this->restInfo]
        );
    }
}
