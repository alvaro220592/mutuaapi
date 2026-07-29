<?php

namespace App\Models\Conversa;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversa extends Model
{
    use SoftDeletes;

    protected $table = 'conversas';

    protected $fillable = ['modulo_id', 'referencia_id'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'conversa_usuario');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class);
    }
}
