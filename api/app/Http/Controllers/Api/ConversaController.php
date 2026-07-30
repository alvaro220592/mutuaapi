<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsentimentoDocumento;
use App\Models\Conversa\ConversaUsuario;
use App\Models\PoliticaPrivacidade;
use App\Models\TermoUso;
use App\Services\ConversaService;
use Illuminate\Http\Request;

/**
 * Para consentimento de política de privacidade, termos de uso, etc
 */

class ConversaController extends Controller
{
    public function __construct(private ConversaService $conversaService)
    {
    }

    public function obterOuCriar(Request $request)
    {
        try {
            $conversa = $this->conversaService->obterOuCriar(
                auth()->id(),
                $request->usuario_doacao_id,
                $request->modulo_id,
                $request->referencia_id
            );

            $conversa->load([
                'mensagens.usuario:id,name'
            ]);

            return response()->json([
                'conversa' => $conversa,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }

    public function enviarMensagem(Request $request)
    {
        try {
            $dados = $request->validate(
                [
                    'mensagem' => 'required|string|max:500'
                ],
                [
                    'mensagem.required' => 'A mensagem é obrigatória.',
                    'mensagem.string' => 'A mensagem deve ser um texto.',
                    'mensagem.max' => 'A mensagem não pode ter mais de 500 caracteres.'
                ]
            );

            $this->conversaService->enviarMensagem(
                $request->conversa_id,
                $dados['mensagem']
            );

            return response()->json([
                'status' => 200
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ]);
        }
    }
}