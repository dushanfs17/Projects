<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAcknowledgment extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    public function __construct($contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build()
    {
        return $this->view('mails.email-notification')
            ->with([
                'message' => $this->contactMessage->message,
                'fullName' => $this->contactMessage->full_name,
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hello From CGD',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.email-notification',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
