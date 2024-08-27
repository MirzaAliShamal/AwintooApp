<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentsRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $agent;
    public $selectedDocuments;
    public $otherText;

    public function __construct($client, $agent, $selectedDocuments, $otherText)
    {
        $this->client = $client;
        $this->agent = $agent;
        $this->selectedDocuments = $selectedDocuments;
        $this->otherText = $otherText;
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
            with: ['client' => $this->client, 
                'agent' => $this->agent,
                'selectedDocuments' => $this->selectedDocuments,
                'otherText' => $this->otherText
            ]
        );
    }
}
