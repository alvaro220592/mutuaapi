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
        $conversa = $this->conversaService->obterOuCriar(
            auth()->id(),
            $request->usuario_doacao_id,
            $request->modulo_id,
            $request->referencia_id
        );

        return response()->json($conversa);
    }
}