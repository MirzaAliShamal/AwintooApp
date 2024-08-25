<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisaAcceptedMail extends Mailable
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
            subject: 'Congratulations! Your Visa Has Been Accepted!'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.visa_accepted',
            with: ['client' => $this->client]
        );
    }
}
