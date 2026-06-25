<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class CodigoRecuperacaoSenha extends Model
{
    protected $table = 'codigos_recuperacao_senha';
    protected $fillable = ['email', 'codigo_recuperacao', 'expira_em'];
}
