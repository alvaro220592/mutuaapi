<?php

namespace App\Services;

use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;

class DoacaoService
{
    public function listar ($filtros) {
        $doacoes = Doacao::with('categoria', 'perfil', 'usuario.regiaoUsuario', 'usuario.telefone');

        // if (isset($filtros['statusAtivo'])) {
        //     $statusAtivo = filter_var(
        //         $filtros['statusAtivo'],
        //         FILTER_VALIDATE_BOOLEAN
        //     );
        //     if (empty($statusAtivo)) {
        //         $doacoes = $doacoes->where('ativo', 0);
        //     } else {
        //         $doacoes = $doacoes->where('ativo', 1);
        //     }
        // }

        // perfil de doação
        if (isset($filtros['perfil'])) {
            if ((int)$filtros['perfil'] != 0) {
                $doacoes = $doacoes->where('perfil_doacao_id', $filtros['perfil']);
            }
        }

        // categoria de doação
        if (isset($filtros['categoria'])) {
            if ((int)$filtros['categoria'] != 0) {
                $doacoes = $doacoes->where('categoria_doacao_id', $filtros['categoria']);
            }
        }
        
        if (isset($filtros['perfil_doacao_id'])) {
            $doacoes = $doacoes->where('perfil_doacao_id', $filtros['perfil_doacao_id']);
        }

        return $doacoes;
    }

    public function criar(array $dados): Doacao
    {
        return Doacao::create([
            'detalhes' => $dados['detalhes'] ?? null,
            'categoria_doacao_id' => $dados['categoria_doacao_id'],
            'perfil_doacao_id' => $dados['perfil_doacao_id'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function atualizar(array $dados, int $id): Doacao
    {
        $doacao = Doacao::find($id);
        
        $doacao->update([
            'detalhes' => $dados['detalhes'] ?? null,
            'categoria_doacao_id' => $dados['categoria_doacao_id'],
            'perfil_doacao_id' => $dados['perfil_doacao_id'],
            'user_id' => auth()->user()->id,
        ]);

        return $doacao;
    }

    public function mudarStatus (int $id) {
        $doacao = Doacao::find($id);
        $doacao->ativo = $doacao->ativo == 0 ? 1: 0;
        $doacao->update();

        return $doacao;
    }

    public function excluir (int $id) {
        $doacao = Doacao::find($id);
        $doacao->delete();
    }

    public function perfisDoacao () {
        return PerfilDoacao::all();
    }

    public function categoriasDoacao () {
        return CategoriaDoacao::all();
    }
}