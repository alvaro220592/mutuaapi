<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
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
