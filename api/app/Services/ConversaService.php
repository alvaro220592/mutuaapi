<?php

namespace App\Services;

use App\Models\Conversa\Conversa;
use Illuminate\Support\Facades\Http;

class ConversaService
{
    public function obterOuCriar(
        int $usuarioLogadoId,
        int $outroUsuarioDoacaoId,
        int $moduloId,
        int $referenciaId
    ) {
        $conversa = Conversa::where('modulo_id', $moduloId)
            ->where('referencia_id', $referenciaId)
            ->whereHas('usuarios', function ($query) use ($usuarioLogadoId) {
                $query->where('users.id', $usuarioLogadoId);
            })
            ->whereHas('usuarios', function ($query) use ($outroUsuarioDoacaoId) {
                $query->where('users.id', $outroUsuarioDoacaoId);
            })
            ->first();

        if ($conversa) {
            return $conversa;
        }

        $conversa = Conversa::create([
            'modulo_id' => $moduloId,
            'referencia_id' => $referenciaId
        ]);

        try {

            $conversa->usuarios()->attach([
                $usuarioLogadoId,
                $outroUsuarioDoacaoId
            ]);
        } catch(\Exception $e) {

            
            \Log::info($e->getMessage());
            }

        return $conversa;
    }

    public function listarMensagens()
    {
        //
    }

    public function enviarMensagem()
    {
        //
    }
}