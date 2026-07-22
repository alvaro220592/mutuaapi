<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use SoftDeletes;
    
    protected $table = 'enderecos';

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'cidade',
        'uf',
        'latitude',
        'longitude',
    ];
}
