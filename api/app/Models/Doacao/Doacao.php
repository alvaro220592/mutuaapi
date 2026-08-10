<?php

namespace App\Models\Doacao;

use App\Models\Modulo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doacao extends Model
{
    use SoftDeletes;

    protected $table = 'doacoes';

    protected $fillable = [
        'ativo',
        'detalhes',
        'categoria_doacao_id',
        'perfil_doacao_id',
        'user_id',
    ];

    protected $appends = ['append_modulo_id'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaDoacao::class, 'categoria_doacao_id');
    }

    public function perfil()
    {
        return $this->belongsTo(PerfilDoacao::class, 'perfil_doacao_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAppendModuloIdAttribute(): int
    {
        return Modulo::DOACOES;
    }
}
