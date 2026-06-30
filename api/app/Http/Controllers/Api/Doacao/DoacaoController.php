<?php

namespace App\Http\Controllers\Api\Doacao;

use App\Http\Controllers\Controller;
use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;
use App\Services\DoacaoService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoacaoController extends Controller
{
    public function __construct(private DoacaoService $doacaoService) {}
    
    public function edit ($id) {
        return response()->json([
            'doacao' => Doacao::find($id)
        ]);
    }

    public function delete ($id) {
        try {
            $this->doacaoService->excluir($id);

            return response()->json([
                'message' => 'Doação excluída com sucesso.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }

    public function mudarStatus (Request $request) {
        try {
            $id = $request->id;
            $this->doacaoService->mudarStatus($id);

            return response()->json([
                'message' => 'Status da doação alterado com sucesso.'
            ]);

        
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.'
            ], 500);
        }
    }
}