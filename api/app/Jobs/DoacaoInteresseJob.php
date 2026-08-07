<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Doacao\Doacao;
use App\Notifications\DoacaoInteresseNotification;
use App\Models\Doacao\PerfilDoacao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DoacaoInteresseJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Doacao $doacao
    ) {
    }

    public function handle(): void
    {
        if ($this->doacao->perfil_doacao_id !== PerfilDoacao::ID_OFERECIDA) {
            return;
        }

        $usuariosInteressados = User::whereHas('doacoes', function ($query) {
            $query->where('perfil_doacao_id', PerfilDoacao::ID_SOLICITADA)
                ->where('categoria_doacao_id', $this->doacao->categoria_doacao_id);
        })->get();

        foreach ($usuariosInteressados as $usuario) {
            $usuario->notify(
                new DoacaoInteresseNotification(
                    $this->doacao->id,
                    $this->doacao->categoria_doacao_id
                )
            );
        }
    }
}