<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioTelefone extends Model
{
    use SoftDeletes;
    
    protected $table = 'usuarios_telefones';

    protected $fillable = ['telefone', 'user_id'];
}
