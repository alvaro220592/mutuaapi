<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContatoUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensagem;
    public $usuario;

    /**
     * Create a new message instance.
     */
    public function __construct($mensagem, $usuario)
    {
        $this->mensagem = $mensagem;
        $this->usuario = $usuario;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MÙTUA - Contato do usuário ' . $this->usuario->name,

            replyTo: [
                new Address(
                    $this->usuario->email,
                    $this->usuario->name
                )
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contato-usuario',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}