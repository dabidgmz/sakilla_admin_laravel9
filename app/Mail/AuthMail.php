<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name; // The user's name
    public string $activationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name,string $activationUrl)
    {
        $this->name = $name;
        $this->activationUrl = $activationUrl;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Activate Your Account',
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
        );
    }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.auth_mail', 
            with: [
                'name' => $this->name,
                'activationUrl' => $this->activationUrl,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
