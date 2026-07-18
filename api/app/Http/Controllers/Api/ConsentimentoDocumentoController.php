<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsentimentoDocumento;
use App\Models\PoliticaPrivacidade;
use App\Models\TermoUso;
use Illuminate\Http\Request;

/**
 * Para consentimento de política de privacidade, termos de uso, etc
 */

class ConsentimentoDocumentoController extends Controller
{

// Aceitar os últimos documentos, que atualmente são política de privacidade e termos de uso
    public function aceitar (Request $request) {
        try {
            $politicaPrivacidadeAtual = PoliticaPrivacidade::orderBy('id', 'desc')->first();
            $termoUsoAtual = TermoUso::orderBy('id', 'desc')->first();

            ConsentimentoDocumento::create([
                'ip' => request()->ip(),
                'user_agent' => $request->userAgent(),
                'politica_privacidade_id' => $politicaPrivacidadeAtual->id,
                'termo_uso_id' => $termoUsoAtual->id,
                'user_id' => auth()->user()->id,
            ]);
            
            return response()->json([
                'message' => 'Aceito com sucesso',
                'status' => 200
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}