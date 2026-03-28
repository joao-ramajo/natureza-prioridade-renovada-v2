<?php

namespace App\Auth\Infrastructure\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $link
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem vindo a NPR, verifique seu Email !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.user.verify-email',
            with: [
                'name' => $this->name,
                'link' => $this->link,
            ]
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
