<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmInvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $agent;
    public $client;

    public function __construct($agent, $client)
    {
        $this->agent = $agent;
        $this->client = $client;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client ('.$this->client->unique_id_number.') – Payment Confirmed and Invoice Sent'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.payment_confirm_invoice',
            with: ['client' => $this->client, 'agent' => $this->agent]
        );
    }

}
