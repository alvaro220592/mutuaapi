<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermoUso extends Model
{
    use SoftDeletes;
    
    protected $table = 'termos_uso';

    protected $fillable = ['versao', 'conteudo',];
}
