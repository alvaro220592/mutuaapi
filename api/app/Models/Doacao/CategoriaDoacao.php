<?php

namespace App\Models\Doacao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaDoacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'categorias_doacao';

    protected $fillable = ['nome', 'ativo'];

    public const ID_OUTROS = 15;
}
