<?php

namespace App\Services;

use App\Models\Doacao\Doacao;

class DoacaoService
{
    public function listar (int $perfilDoacaoId) {
        
        return Doacao::
            with('categoria_doacao')
            ->where('user_id', auth()->id())
            ->where('perfil_doacao_id', $perfilDoacaoId)
            ->paginate(10);
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
}