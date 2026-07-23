<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\CodigoRecuperacaoSenhaMail;
use App\Models\Auth\CodigoRecuperacaoSenha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail iválido',
            'password.required' => 'A senha é obrigatória',
        ]);

        $user = User::where('email', $credenciais['email'])->first();

        // se o usuário foi criado através do google
        if ($user && $user->google_id) {
            return response()->json([
                'message' => 'Esta conta foi criada com Google. Faça login com Google para continuar.',
            ], 403);
        }

        if (!Auth::attempt($credenciais)) {
            return response()->json([
                'message' => 'Credenciais inválidas',
            ], 401);
        }

        $user = Auth::user();

        $user->load('telefone');
        $user->load('regiaoUsuario');

        $user->tokens()->delete();

        $token = $user->createToken('mutuaapitoken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function loginGoogle(Request $request)
    {
        $request->validate([
            'idToken' => 'required'
        ]);

        $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $request->idToken
        ]);

        if ($response->failed()) {
            \Log::error('GOOGLE LOGIN - TOKEN INVÁLIDO', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json(['error' => 'Token inválido'], 401);
        }

        $googleUser = $response->json();

        \Log::info('GOOGLE LOGIN - RESPOSTA DO GOOGLE', $googleUser);

        // valida audiência (IMPORTANTE: usar CLIENT ID WEB)
        if (($googleUser['aud'] ?? null) !== env('VITE_GOOGLE_AUTH_WEB_CLIENT_ID')) {
            return response()->json(['error' => 'Invalid audience'], 401);
        }

        // procura primeiro pelo google_id (forma mais segura)
        $user = User::where('google_id', $googleUser['sub'] ?? null)->first();

        // fallback por email
        if (!$user) {
            $user = User::where('email', $googleUser['email'] ?? null)->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $googleUser['name'] ?? 'Usuário Google',
                'email' => $googleUser['email'],
                'google_id' => $googleUser['sub'],
                'password' => bcrypt(Str::random(32)),
            ]);
        } else {
            // garante vínculo com Google
            if (empty($user->google_id)) {
                $user->update([
                    'google_id' => $googleUser['sub'],
                ]);
            }
        }

        // invalida tokens antigos
        $user->tokens()->delete();

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    public function cadastrar(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'name.required' => 'O nome de usuário é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail iválido',
            'email.unique' => 'Este e-mail já está cadastrado',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.confirmed' => 'A confirmação da senha não confere',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user
            ->createToken('mutuaapitoken')
            ->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logout realizado',
        ]);
    }

    public function recuperarSenha(Request $request)
    {

        $dados = $request->validate([
            'email' => 'required|email|exists:users,email'
        ],
        [
            'email.required' => 'O e-mail é obrigatório',
        ]);

        $usuario = User::where('email', $dados['email'])->first();

        $codigoRecuperacao = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // deletando um codigo anterior
        CodigoRecuperacaoSenha::where(
            'email',
            $usuario->email
        )->delete();

        CodigoRecuperacaoSenha::create([
            'email' => $usuario->email,
            'codigo_recuperacao' => $codigoRecuperacao,
            'expira_em' => now()->addMinutes(15),
        ]);

        Mail::to($dados['email'])->send(new CodigoRecuperacaoSenhaMail(
            nomeUsuario: $usuario->name,
            codigoRecuperacao: $codigoRecuperacao
        ));

        return response()->json([
            'message' => 'E-mail enviado com sucesso'
        ]);
    }

    public function redefinirSenha(Request $request)
    {

        // Valida entrada
        $request->validate([
            'email' => 'required|email',
            'codigo_recuperacao' => 'required|digits:6',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ],
        [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail iválido',
            'codigo_recuperacao.required' => 'O código de verificação é obrigatório',
            'password.required' => 'A senha é obrigatória',
            'password.string' => 'A senha deve ser em formato de texto',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.confirmed' => 'A confirmação da senha não confere',
        ]);

        $codigoRecuperacao = CodigoRecuperacaoSenha::
            where('email', $request->email)
            ->where('expira_em', '>', now())
            ->where('codigo_recuperacao', $request->codigo_recuperacao)
            ->first();

        // Código inexistente ou expirado
        if (!$codigoRecuperacao) {
            return response()->json([
                'message' => 'Código inválido ou expirado',
            ], 422);
        }

        // Atualiza senha
        User::where('email', $request->email)->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);

        // impedindo a reutilização
        $codigoRecuperacao->delete();

        return response()->json([
            'message' => 'Código válido',
        ]);
    }
}
