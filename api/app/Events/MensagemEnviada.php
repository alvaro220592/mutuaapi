<?php

namespace App\Events;

use App\Models\Conversa\Mensagem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MensagemEnviada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Mensagem $mensagem)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        $canais = [new PrivateChannel('conversa.' . $this->mensagem->conversa_id)];

        foreach ($this->mensagem->conversa->usuarios as $usuario) {
            $canais[] = new PrivateChannel('App.Models.User.' . $usuario->id);
        }

        return $canais;
    }

    public function broadcastAs()
    {
        return 'mensagem.enviada';
    }
}