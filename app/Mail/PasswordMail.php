<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $activationUrl;

    public function __construct(string $name, string $activationUrl)
    {
        $this->name = $name;
        $this->activationUrl = $activationUrl;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Your Password',
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.passwd_mail', 
            with: [
                'name' => $this->name,
                'activationUrl' => $this->activationUrl,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
