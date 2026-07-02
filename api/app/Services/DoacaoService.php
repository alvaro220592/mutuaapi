<?php

namespace App\Services;

use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;

class DoacaoService
{
    public function listar (?int $perfilDoacaoId = null) {
        
        $doacoes = Doacao::with('categoria_doacao', 'usuario');

        if ($perfilDoacaoId) {
            $doacoes = $doacoes->where('perfil_doacao_id', $perfilDoacaoId);
        }
        
        $doacoes = $doacoes->paginate(10);

        return $doacoes;
    }

    public function criar(array $dados, int $perfilDoacaoId): Doacao
    {
        return Doacao::create([
            'detalhes' => $dados['detalhes'] ?? null,
            'categoria_doacao_id' => $dados['categoria_doacao_id'],
            'perfil_doacao_id' => $perfilDoacaoId,
            'user_id' => auth()->id(),
        ]);
    }

    public function atualizar(array $dados, int $id): Doacao
    {
        $doacao = Doacao::find($id);
        
        $doacao->update([
            'detalhes' => $dados['detalhes'] ?? null,
            'categoria_doacao_id' => $dados['categoria_doacao_id'],
            'perfil_doacao_id' => $dados['perfil_doacao_id'],
            'user_id' => $dados['user_id'],
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
}