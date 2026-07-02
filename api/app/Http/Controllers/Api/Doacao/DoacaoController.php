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
    
    public function index () {
        try {
            $doacoes = $this->doacaoService->listar();

            return response()->json([
                'doacoes' => $doacoes,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $dados = $request->validate(
            [
                'categoria_doacao_id' => ['required'],
                'perfil_doacao_id' => ['required'],
                'user_id' => ['required'],
                'detalhes' => [
                    Rule::requiredIf($request->categoria_doacao_id == CategoriaDoacao::ID_OUTROS),
                    'nullable',
                    'string',
                    'max:500',
                ],
            ],
            [
                'categoria_doacao_id.required' => 'Selecione uma categoria',
                'perfil_doacao_id.required' => 'Selecione um perfil para a doação',
                'user_id.required' => 'Selecione um usuário',
                'detalhes.required' => 'Para este tipo de doação, os detalhes são obrigatórios',
            ]
        );

        try {
            $this->doacaoService->criar($dados, $request->perfil_doacao_id);

            return response()->json([
                'message' => 'Doação cadastrada com sucesso.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.'
            ], 500);
        }
    }

    public function update (Request $request, $id) {
        try {
            $this->doacaoService->atualizar($request->all(), $id);
            
            return response()->json([
                'message' => 'Doação editada com sucesso.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.'
            ], 500);
        }
    }

    public function edit ($id) {
        return response()->json([
            'doacao' => Doacao::with('categoria_doacao', 'usuario')->find($id)
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

    public function perfisDoacao () {
        try {
            $perfisDoacao = $this->doacaoService->perfisDoacao();
            return response()->json([
                'perfisDoacao' => $perfisDoacao
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.'
            ], 500);
        }
    }
}