<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermoUso;
use App\Services\LocalizacaoService;
use Illuminate\Http\Request;

class LocalizacaoController extends Controller
{
    public function buscarRegiaoPeloCep ($cep) {
        try {
            if (!$cep) {
                return;
            }

            $endereco = app(LocalizacaoService::class)->buscarRegiaoPeloCep($cep);

            if (!$endereco) {
                return response()->json([
                    'message' => 'CEP inválido ou não encontrado'
                ], 500);
            }
            
            return response()->json($endereco);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}