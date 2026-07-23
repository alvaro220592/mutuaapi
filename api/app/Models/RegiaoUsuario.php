<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegiaoUsuario extends Model
{
    use SoftDeletes;
    
    protected $table = 'regioes_usuarios';

    protected $fillable = [
        'bairro',
        'cidade',
        'uf',
        'latitude',
        'longitude',
    ];
}
