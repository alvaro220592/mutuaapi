<?php

namespace App\Models\Doacao;

use Illuminate\Database\Eloquent\Model;

class CategoriaDoacao extends Model
{
    protected $table = 'categorias_doacao';

    protected $fillable = ['nome', 'ativo'];

    public const ID_OUTROS = 15;
}
