<?php

namespace App\Models\Conversa;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
    use SoftDeletes;

    protected $table = 'mensagens';

    protected $fillable = ['conversa_id', 'user_id', 'mensagem', 'lida_em'];

    protected $appends = ['minha', 'dataAmigavel']; // util para a formatação do balão no frontend

    public function getDataAmigavelAttribute()
    {
        return $this->created_at->locale('pt_BR')->diffForHumans();
    }

    public function conversa()
    {
        return $this->belongsTo(Conversa::class, 'conversa_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMinhaAttribute()
    {
        return $this->user_id === auth()->id();
    }
}
