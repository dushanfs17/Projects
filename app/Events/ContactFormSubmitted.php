<?php

namespace App\Events;

use App\Models\ContactForm;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contactMessage;

    public function __construct(ContactForm $contactForm)
    {
        $this->contactMessage = $contactForm;
    }
}
