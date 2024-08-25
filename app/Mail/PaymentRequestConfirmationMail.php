<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentRequestConfirmationMail extends Mailable
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
            subject: 'Client ('.$this->client->unique_id_number.') – Payment Made – Please Confirm'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.payment_request_confirm',
            with: ['client' => $this->client]
        );
    }
}
