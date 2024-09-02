<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArrivalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Arrival Mail'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.arrival',
            with: ['student' => $this->student]
        );
    }
}