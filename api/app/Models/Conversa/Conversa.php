<?php

namespace App\Models\Conversa;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversa extends Model
{
    use SoftDeletes;

    protected $table = 'conversas';

    protected $fillable = ['modulo_id', 'referencia_id', 'assunto'];

    protected $appends = ['ultimaMensagem'];

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'conversa_usuario',
            'conversa_id',
            'user_id'
        );
    }

    // o outro usuário da conversa
    public function outrosUsuarios()
    {
        return $this->belongsToMany(
            User::class,
            'conversa_usuario',
            'conversa_id',
            'user_id'
        )->where('users.id', '!=', auth()->id());
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class);
    }

    public function getUltimaMensagemAttribute()
    {
        return $this->mensagens()
            ->orderByDesc('id')
            ->first();
    }
}
