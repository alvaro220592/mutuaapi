<?php

namespace App\Http\Controllers\Api\Doacao;

use App\Http\Controllers\Controller;
use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;
use App\Models\Modulo;
use App\Services\DoacaoService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoacaoController extends Controller
{
    public function __construct(private DoacaoService $doacaoService) {}
    
    public function lista (Request $request) {
        try {
            $dados = $request->all();
            $doacoes = $this->doacaoService->listar($dados);
            
            // apenas na lista, as doações são limitadas às do usuário
            if (!isset($dados['admin'])) {
                $doacoes = $doacoes->where('user_id', auth()->user()->id);
            }

            $doacoes = $doacoes->paginate(10);
            $perfisDoacao = $this->doacaoService->perfisDoacao();
            $categoriasDoacao = $this->doacaoService->categoriasDoacao();

            return response()->json([
                'doacoes' => $doacoes,
                'perfisDoacao' => $perfisDoacao,
                'categoriasDoacao' => $categoriasDoacao,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }

    public function mapa (Request $request) {
        try {
            $dados = $request->all();

            // apenas aqui na listagem por mapa tem que vim registros sempre ativos
            $doacoes = $this->doacaoService
                ->listar($dados)
                ->where('ativo', 1)
                ->get();

            $perfisDoacao = $this->doacaoService->perfisDoacao();
            $categoriasDoacao = $this->doacaoService->categoriasDoacao();

            $usuario = auth()->user();
            $usuario->load('regiaoUsuario');

            return response()->json([
                'moduloId' => Modulo::DOACOES,
                'doacoes' => $doacoes,
                'perfisDoacao' => $perfisDoacao,
                'categoriasDoacao' => $categoriasDoacao,
                'usuario' => $usuario,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $dados = $request->validate(
            [
                'categoria_doacao_id' => ['required'],
                'perfil_doacao_id' => ['required'],
                'detalhes' => [
                    Rule::requiredIf($request->categoria_doacao_id == CategoriaDoacao::ID_OUTROS),
                    'nullable',
                    'string',
                    'max:500',
                ],
            ],
            [
                'categoria_doacao_id.required' => 'Selecione do que se trata a doação',
                'perfil_doacao_id.required' => 'Selecione se quer doar ou solicitar',
                'detalhes.required' => 'Para este tipo de doação, os detalhes são obrigatórios',
            ]
        );

        try {
            $this->doacaoService->criar($dados);

            return response()->json([
                'message' => 'Doação cadastrada com sucesso.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
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
            'doacao' => Doacao::with('categoria', 'usuario', 'perfil')->find($id)
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