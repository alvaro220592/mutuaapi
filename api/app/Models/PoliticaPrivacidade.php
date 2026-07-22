<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliticaPrivacidade extends Model
{
    use SoftDeletes;
    
    protected $table = 'politicas_privacidade';

    protected $fillable = ['versao', 'conteudo',];
}
