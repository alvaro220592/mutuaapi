<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Verifica se o usuário já aceitou a ultima versão da política de privacidade e termos de uso
 */

class VerificarConsentimentoDocumentos
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs([
            'logout',
            'consentimento.aceitar',
            'politica-privacidade.atual',
            'termo-uso.atual',
        ])) {
            return $next($request);
        }

        $usuario = $request->user();

        if (!$usuario) {
            return $next($request);
        }

        if (!$usuario->aceitouUltimosDocumentos()) {
            \Log::info('nao aceitou');

            return response()->json([
                'codigo' => 'DOCUMENTOS_PENDENTES',
                'message' => 'É necessário aceitar os Termos de Uso e a Política de Privacidade.'
            ], 428);
        }

        return $next($request);
    }
}