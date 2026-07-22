<?php

namespace App\Models\Doacao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilDoacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'perfis_doacao';

    protected $fillable = ['nome', 'ativo'];

    public const ID_OFERECIDA = 1;
    public const ID_SOLICITADA = 2;
}
