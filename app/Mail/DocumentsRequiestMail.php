<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentsRequiestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $agent;
    public $message;

    public function __construct($client, $agent, $message)
    {
        $this->client = $client;
        $this->agent = $agent;
        $this->message = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Urgent: Additional Documents Required for '. $this->client->full_name . ' Application'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.document_request',
            with: ['client' => $this->client, 'agent' => $this->agent, 'customMessage' => $this->message,]
        );
    }
}
