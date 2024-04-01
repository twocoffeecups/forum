<?php

namespace App\Mail\Client\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;
    public string $login;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $login, $hash)
    {
        $this->login = $login;
        //$this->url = route('verification.verify', ['id'=>$id, 'hash'=>$hash]);
        $this->url = route('email.verify', ['id'=>$id, 'hash'=>$hash]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Verify Mail',
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
            markdown: 'mail.client.user.verify-mail',
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
