<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTelefone extends Model
{
    protected $table = 'usuarios_telefones';

    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'icone',
        'ativo',
        'ordem_exibicao',
    ];
}
