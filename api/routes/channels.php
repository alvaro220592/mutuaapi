<?php

use App\Models\Conversa\Conversa;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// definindo quem pode participar do canal
Broadcast::channel('conversa.{conversaId}', function ($user, $conversaId) {
    return Conversa::where('id', $conversaId)
        ->whereHas('usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->exists();
});

// canal do usuário
Broadcast::channel('usuario.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});