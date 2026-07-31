<?php

namespace App\Services;

use App\Events\MensagemEnviada;
use App\Models\Conversa\Conversa;
use App\Models\Conversa\Mensagem;
use Illuminate\Support\Facades\Http;

class ConversaService
{
    public function obterOuCriar(
        int $usuarioLogadoId,
        int $outroUsuarioId,
        int $moduloId,
        int $referenciaId,
        string $assunto,
    ) {
        $conversa = Conversa::with('outrosUsuarios')
            ->where('modulo_id', $moduloId)
            ->where('referencia_id', $referenciaId)
            ->whereHas('usuarios', function ($query) use ($usuarioLogadoId) {
                $query->where('users.id', $usuarioLogadoId);
            })
            ->whereHas('usuarios', function ($query) use ($outroUsuarioId) {
                $query->where('users.id', $outroUsuarioId);
            })
            ->first();

        if ($conversa) {
            return $conversa;
        }

        $conversa = Conversa::create([
            'modulo_id' => $moduloId,
            'referencia_id' => $referenciaId,
            'assunto' => $assunto
        ]);

        try {
            $conversa->usuarios()->attach([
                $usuarioLogadoId,
                $outroUsuarioId
            ]);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }

        return $conversa;
    }

    public function listarMensagens()
    {
        //
    }

    public function enviarMensagem($conversaId, $mensagem)
    {
        $novaMensagem = Mensagem::create([
            'mensagem' => $mensagem,
            'conversa_id' => $conversaId,
            'user_id' => auth()->user()->id
        ]);

        $novaMensagem->load('usuario');

        broadcast(new MensagemEnviada($novaMensagem));

        return $novaMensagem;
    }

    public function conversasUsuarioLogado()
    {
        return Conversa::with('outrosUsuarios')
            ->whereHas('usuarios', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->whereHas('mensagens')
            ->get();
    }
}