<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientValidationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $agent;
    public $validationOption;

    public function __construct($client, $agent, $validationOption)
    {
        $this->client = $client;
        $this->agent = $agent;
        $this->validationOption = $validationOption;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client Validation Successful - '. $this->client->full_name
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.client_validation',
            with: ['client' => $this->client, 'agent' => $this->agent, 'validationOption' => $this->validationOption,]
        );
    }
}
