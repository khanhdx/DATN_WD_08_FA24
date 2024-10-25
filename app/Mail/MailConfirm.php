<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $images;

    public function __construct($contact, $images)
    {
        $this->contact = $contact;
        $this->images = $images;
    }

    public function build()
    {
        $email = $this->view('client.contact.mail')
            ->with('contact', $this->contact)
            ->subject('Liên hệ từ website');

        if ($this->images) {
            $email->attach(storage_path('app/public/' . $this->images));
        }

        return $email;
    }

}
