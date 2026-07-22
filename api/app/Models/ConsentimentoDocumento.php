<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsentimentoDocumento extends Model
{
    use SoftDeletes;
    
    protected $table = 'consentimentos_documentos';

    protected $fillable = [
        'ip',
        'user_agent',
        'politica_privacidade_id',
        'termo_uso_id',
        'user_id',
    ];
}
