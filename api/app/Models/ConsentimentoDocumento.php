<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentimentoDocumento extends Model
{
    protected $table = 'consentimentos_documentos';

    protected $fillable = [
        'ip',
        'user_agent',
        'politica_privacidade_id',
        'termo_uso_id',
        'user_id',
    ];
}
