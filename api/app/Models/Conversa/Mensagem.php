<?php

namespace App\Models\Conversa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
    use SoftDeletes;
    
    protected $table = 'mensagens';

    protected $fillable = ['conversa_id', 'usuario_id', 'mensagem', 'lida_em'];
}
