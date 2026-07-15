<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContatoUsuarioMail;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoUsuarioController extends Controller
{
    public function email (Request $request) {
        try {
            Mail::to(config('mail.contato'))->send(new ContatoUsuarioMail($request->mensagem, auth()->user()));
            
            return response()->json([
                'message' => 'Mensagem enviada com sucesso. Em breve retornaremos.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}