<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticaPrivacidade extends Model
{
    protected $table = 'politicas_privacidade';

    protected $fillable = ['versao', 'conteudo',];
}
