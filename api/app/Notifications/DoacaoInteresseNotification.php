<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class DoacaoInteresseNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $doacaoId,
        public int $categoriaDoacaoId
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'database',
            'broadcast'
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'tipo' => 'nova_doacao_interesse',
            'doacao_id' => $this->doacaoId,
            'categoria_doacao_id' => $this->categoriaDoacaoId,
            'mensagem' => 'Existe uma nova doação do seu interesse.'
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'tipo' => 'nova_doacao_interesse',
            'doacao_id' => $this->doacaoId,
            'categoria_doacao_id' => $this->categoriaDoacaoId,
            'mensagem' => 'Existe uma nova doação do seu interesse.'
        ]);
    }
}