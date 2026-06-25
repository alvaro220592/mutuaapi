<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoRecuperacaoSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeUsuario;
    public $codigoRecuperacao;

    /**
     * Create a new message instance.
     */
    public function __construct($nomeUsuario, $codigoRecuperacao)
    {
        $this->nomeUsuario = $nomeUsuario;
        $this->codigoRecuperacao = $codigoRecuperacao;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MUTUA - Recuperação de Senha',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.codigo-recuperacao-senha',
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
