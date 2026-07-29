<?php

namespace App\Models\Conversa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversaUsuario extends Model
{
    use SoftDeletes;

    protected $table = 'conversa_usuario';

    protected $fillable = ['conversa_id', 'user_id'];

    public function conversa()
    {
        return $this->belongsTo(Conversa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
