<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class ExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct($client, $title)
    {
        $this->client = $client;
        $this->title = $title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title .' Expiry Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.expiry',
            with: [
                'title' => $this->title,
                'full_name' => $this->client->full_name,
                'expiry_date' => $this->client->expiry_date,
                'days_left' => $this->client->daysLeft,
            ]
        );
    }
}
