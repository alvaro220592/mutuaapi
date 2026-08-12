<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContatoUsuarioMail;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificacaoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 20);

            $notificacoes = auth()->user()
                ->notifications()
                ->latest()
                ->paginate($perPage);

            $notificacoes->getCollection()->each(function ($notificacao) {
                $notificacao->setAttribute(
                    'dataAmigavel',
                    $notificacao->created_at
                        ->locale('pt_BR')
                        ->diffForHumans()
                );
            });

            return response()->json([
                'notificacoes' => $notificacoes,

                'notificacoesNaoLidas' => auth()->user()
                    ->unreadNotifications()
                    ->count(),
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }

    public function marcarComoLidas()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            return response()->json([
                'message' => 'ok'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro. Entre em contato com a equipe de desenvolvimento.' . $e->getMessage()
            ], 500);
        }
    }
}