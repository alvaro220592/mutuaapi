<?php

namespace App\Models\Doacao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilDoacao extends Model
{
    use SoftDeletes;
    
    protected $table = 'perfis_doacao';

    protected $fillable = ['nome', 'descricao', 'ativo'];

    public const int ID_OFERECIDA = 1;
    public const int ID_SOLICITADA = 2;
}
