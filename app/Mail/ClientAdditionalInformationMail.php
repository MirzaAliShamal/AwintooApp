<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientAdditionalInformationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client ('.$this->client->unique_id_number.') – Additional Information and Documents Attached'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.client_additional_information',
            with: ['client' => $this->client]
        );
    }
}
