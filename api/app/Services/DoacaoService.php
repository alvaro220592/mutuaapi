<?php

namespace App\Services;

use App\Jobs\DoacaoInteresseJob;
use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\Doacao;
use App\Models\Doacao\PerfilDoacao;
use App\Models\User;

class DoacaoService
{
    public function listar($filtros)
    {
        $doacoes = Doacao::with('categoria', 'perfil', 'usuario.regiaoUsuario', 'usuario.telefone');

        // perfil de doação
        if (isset($filtros['perfil'])) {
            $doacoes = $doacoes->where('perfil_doacao_id', $filtros['perfil']);
        }

        // categoria de doação
        if (isset($filtros['categorias'])) {
            $categorias = explode(',', $filtros['categorias']);
            $doacoes = $doacoes->whereIn('categoria_doacao_id', $categorias);
        }

        if (isset($filtros['usuario'])) {
            $doacoes = $doacoes->where('user_id', $filtros['usuario']);
        }

        if (isset($filtros['apenasCategoriasInteresse'])) {
            $mostrarApenasCategoriasInteresse = filter_var(
                $filtros['apenasCategoriasInteresse'],
                FILTER_VALIDATE_BOOLEAN
            );

            if ($mostrarApenasCategoriasInteresse) {
                $doacoes = $doacoes->whereIn('categoria_doacao_id', $this->categoriasInteresse());
            }
        }

        return $doacoes;
    }

    public function criar(array $dados): Doacao
    {
        $doacao = Doacao::create([
            'detalhes' => $dados['detalhes'] ?? null,
            'categoria_doacao_id' => $dados['categoria_doacao_id'],
            'perfil_doacao_id' => $dados['perfil_doacao_id'],
            'user_id' => auth()->user()->id,
        ]);

        if ($doacao->perfil_doacao_id === PerfilDoacao::ID_OFERECIDA) {
            DoacaoInteresseJob::dispatch($doacao);
        }

        return $doacao;
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

    public function categoriasInteresse()
    {
        return auth()->user()
            ->doacoes
            ->pluck('categoria_doacao_id')
            ->unique()
            ->values();
    }

    public function mudarStatus(int $id)
    {
        $doacao = Doacao::find($id);
        $doacao->ativo = $doacao->ativo == 0 ? 1 : 0;
        $doacao->update();

        return $doacao;
    }

    public function excluir(int $id)
    {
        $doacao = Doacao::find($id);
        $doacao->delete();
    }

    public function perfisDoacao()
    {
        return PerfilDoacao::all();
    }

    public function categoriasDoacao()
    {
        return CategoriaDoacao::all();
    }
}