<?php

namespace App\Models\Doacao;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $table = 'doacoes';

    protected $fillable = [
        'ativo',
        'detalhes',
        'categoria_doacao_id',
        'perfil_doacao_id',
        'user_id',
    ];

    public function categoria_doacao () {
        return $this->belongsTo(CategoriaDoacao::class, 'categoria_doacao_id');
    }

    public function usuario () {
        return $this->belongsTo(User::class, 'user_id');
    }
}
