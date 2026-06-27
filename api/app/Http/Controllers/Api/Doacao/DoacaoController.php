<?php

namespace App\Http\Controllers\Api\Doacao;

use App\Http\Controllers\Controller;
use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoacaoController extends Controller
{
    public function index () {
        try {
            $doacoes = Doacao::
                with('categoria_doacao')
                ->where('user_id', auth()->user()->id)->get();
            
            return response()->json([
                'doacoes' => $doacoes,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function novo (Request $request) {
        $dados = $request->validate([
            'categoria_doacao_id' => ['required'],
            'detalhes' => [
                Rule::requiredIf(
                    $request->categoria_doacao_id == CategoriaDoacao::ID_OUTROS
                ),
                'nullable',
                'string',
                'max:500'
            ]
        ],
        [
            'categoria_doacao_id.required' => 'Selecione uma categoria',
            'detalhes.required' => 'Para este tipo de doação, os detalhes são obrigatórios',
        ]);

        try {
            Doacao::create([
                'detalhes' => $dados['detalhes'],
                'categoria_doacao_id' => $dados['categoria_doacao_id'],
                'perfil_doacao_id' => $request->perfil_doacao_id == PerfilDoacao::ID_SOLICITADA ? PerfilDoacao::ID_SOLICITADA : PerfilDoacao::ID_OFERECIDA,
                'user_id' => auth()->user()->id,
            ]);

            return response()->json([
                'message' => $request->all()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}