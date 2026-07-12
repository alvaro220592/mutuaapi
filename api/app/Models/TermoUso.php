<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermoUso extends Model
{
    protected $table = 'termos_uso';

    protected $fillable = ['versao', 'conteudo',];
}
