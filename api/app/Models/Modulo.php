<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;
    
    protected $table = 'modulos';

    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'icone',
        'ativo',
        'ordem_exibicao',
    ];

    public const int DOACOES = 1;
}
