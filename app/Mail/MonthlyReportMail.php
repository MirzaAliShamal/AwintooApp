<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyReportMail extends Mailable
{
   use Queueable, SerializesModels;
    
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail to HR for Monthly Report'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.monthly_report',
            with: ['students' => $this->students]
        );
    }
}
