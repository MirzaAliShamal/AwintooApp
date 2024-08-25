<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $agent;

    public function __construct($client, $agent)
    {
        $this->client = $client;
        $this->agent = $agent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client Application Update - '. $this->client->full_name
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.application_reject',
            with: ['client' => $this->client, 'agent' => $this->agent,]
        );
    }
}
