<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\User;
use App\Models\UsuarioTelefone;
use App\Services\CoordenadasService;
use App\Services\LocalizacaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $usuarios = User::orderBy('name')->get();

            return response()->json([
                'usuarios' => $usuarios
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function listarPaginados () {
        try {
            $usuarios = User::with(['telefone', 'regiaoUsuario'])
                ->orderBy('name');

            $busca = request()->busca;

            if ($busca) {
                $usuarios->where(function ($query) use ($busca) {
                    $query->where('name', 'like', "%{$busca}%")
                        ->orWhere('email', 'like', "%{$busca}%")
                        ->orWhereHas('telefone', function ($query) use ($busca) {
                            $query->where('telefone', 'like', "%{$busca}%");
                        })
                        ->orWhereHas('regiaoUsuario', function ($query) use ($busca) {
                            $query
                                ->orWhere('bairro', 'like', "%{$busca}%")
                                ->orWhere('cidade', 'like', "%{$busca}%")
                                ->orWhere('uf', 'like', "%{$busca}%");
                        });
                });
            }

            $usuarios = $usuarios->paginate(10);
            
            return response()->json([
                'usuarios' => $usuarios
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],

            'telefone' => ['nullable', 'string'],

            'cep' => ['nullable', 'string'],
            'cidade' => ['nullable', 'string'],
            'bairro' => ['nullable', 'string'],
            'uf' => ['nullable', 'string'],

            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $usuario = User::findOrFail(auth()->id());

        /*
        |--------------------------------------------------------------------------
        | DADOS DO USUÁRIO
        |--------------------------------------------------------------------------
        */

        $usuario->name = $dados['nome'];

        // senha ausente → não altera
        // senha preenchida → altera
        if (filled($dados['password'] ?? null)) {
            $usuario->password = Hash::make($dados['password']);
        }

        $usuario->save();



        /*
        |--------------------------------------------------------------------------
        | TELEFONE
        |--------------------------------------------------------------------------
        |
        | telefone ausente → não mexe
        | telefone preenchido → cria/atualiza
        | telefone vazio → exclui
        |
        */

        $telefone = UsuarioTelefone::where('user_id', $usuario->id)->first();

        if (array_key_exists('telefone', $dados)) {

            if (filled($dados['telefone'])) {

                if (!$telefone) {
                    $telefone = new UsuarioTelefone();
                    $telefone->user_id = $usuario->id;
                }

                $telefone->telefone = $dados['telefone'];

                $telefone->save();

            } else {

                $telefone?->delete();
            }
        }



        /*
        |--------------------------------------------------------------------------
        | ENDEREÇO
        |--------------------------------------------------------------------------
        |
        | endereço todo vazio → não altera
        | começou preencher → exige completar
        |
        */

        $camposEndereco = [
            'cep',
            'bairro',
            'cidade',
            'uf',
        ];

        $preencheuEndereco = false;

        foreach ($camposEndereco as $campo) {

            if (filled($dados[$campo] ?? null)) {
                $preencheuEndereco = true;
                break;
            }
        }

        if ($preencheuEndereco) {

            foreach ($camposEndereco as $campo) {

                if (!filled($dados[$campo] ?? null)) {

                    throw ValidationException::withMessages([
                        $campo => 'Preencha todos os campos obrigatórios do endereço.'
                    ]);
                }
            }

            $endereco = $usuario->endereco;

            if (!$endereco) {
                $endereco = new Endereco;
            }

            $endereco->cep = $dados['cep'];
            $endereco->bairro = $dados['bairro'];
            $endereco->cidade = $dados['cidade'];
            $endereco->uf = $dados['uf'];



            $fullAddress =
                $dados['bairro'] . ', ' .
                $dados['cidade'] . ', ' .
                $dados['uf'] . ', Brasil';

            $coordenadas = app(LocalizacaoService::class)->coordenadasPeloEndereco($fullAddress);

            if ($coordenadas) {
                $endereco->latitude = $coordenadas['latitude'];
                $endereco->longitude = $coordenadas['longitude'];
            }

            $endereco->save();

            if (!$usuario->endereco_id) {
                $usuario->endereco_id = $endereco->id;
                $usuario->save();
            }
        }

        return response()->json([
            'message' => 'Perfil atualizado',
            'user' => $usuario
                ->fresh()
                ->load('telefone')
                ->load('regiaoUsuario'),
        ]);
    }

    public function info()
    {
        $usuario = auth()->user();
        $usuario->load('telefone');
        $usuario->load('regiaoUsuario');

        return response()->json([
            'usuario' => $usuario
        ]);
    }

    public function excluirConta(Request $request)
    {
        try {
            $request
                ->user()
                ->currentAccessToken()
                ->delete();

            auth()->user()->delete();

            return response()->json([
                'message' => 'Conta excluída com sucesso',

            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Erro ao excluir. Entre em contato com a equipe de desenvolvimento',
            ]);
        }
    }
}