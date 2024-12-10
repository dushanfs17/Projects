<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;

class SendContactFormAcknowledgement
{
    public function handle(ContactFormSubmitted $event)
    {
        $message = $event->contactMessage;

        Mail::to($message->email)->send(new \App\Mail\ContactAcknowledgment($message));
    }
}
