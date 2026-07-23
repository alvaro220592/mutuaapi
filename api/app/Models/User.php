<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email', 'password', 'google_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use SoftDeletes, HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $appends = ['is_admin'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function telefone()
    {
        return $this->hasOne(UsuarioTelefone::class, 'user_id');
    }

    public function regiaoUsuario()
    {
        return $this->belongsTo(RegiaoUsuario::class, 'regiao_usuario_id');
    }

    // atribui verdadeiro ou falso à propriedade 'is_admin' aqui da model, que foi agregada ao usuário
    public function getIsAdminAttribute(): bool
    {
        return $this->hasRole('admin');
    }

    // se aceitou os ultimos politica de privacidade e os termos de uso
    public function aceitouUltimosDocumentos()
    {
        $politicaPrivacidadeAtual = PoliticaPrivacidade::latest('id')->first();
        $termoUsoAtual = TermoUso::latest('id')->first();

        // Se ainda não existem documentos, considera como aceito
        if (!$politicaPrivacidadeAtual || !$termoUsoAtual) {
            return true;
        }

        return ConsentimentoDocumento::where([
            'user_id' => auth()->id(),
            'politica_privacidade_id' => $politicaPrivacidadeAtual->id,
            'termo_uso_id' => $termoUsoAtual->id,
        ])->exists();
    }
}