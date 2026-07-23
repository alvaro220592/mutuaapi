<?php

namespace Database\Seeders;

use App\Models\RegiaoUsuario;
use App\Models\User;
use App\Models\UsuarioTelefone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuariosTeste = [
            [
                'nome' => 'joao_teste',
                'regiao_usuario' => [
                    'cidade' => 'Cotia',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6031,
                    'longitude' => -46.9182,
                ],
                'telefone' => '11901234567'
            ],
            [
                'nome' => 'maria_teste',
                'regiao_usuario' => [
                    'cidade' => 'Cotia',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5964,
                    'longitude' => -46.9229,
                ],
                'telefone' => '11901239874'
            ],
            [
                'nome' => 'pedro_teste',
                'regiao_usuario' => [
                    'cidade' => 'Cotia',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5897,
                    'longitude' => -46.9285,
                ],
                'telefone' => '11901232587'
            ],
            [
                'nome' => 'ana_teste',
                'regiao_usuario' => [
                    'cidade' => 'Cotia',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6105,
                    'longitude' => -46.9114,
                ],
                'telefone' => '11901237412'
            ],
            [
                'nome' => 'carlos_teste',
                'regiao_usuario' => [
                    'cidade' => 'Cotia',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6076,
                    'longitude' => -46.9361,
                ],
                'telefone' => '11901233652'
            ],
            [
                'nome' => 'julia_teste',
                'regiao_usuario' => [
                    'cidade' => 'Vargem Grande Paulista',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6038,
                    'longitude' => -47.0271,
                ],
                'telefone' => '11978474567'
            ],
            [
                'nome' => 'lucas_teste',
                'regiao_usuario' => [
                    'cidade' => 'Vargem Grande Paulista',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6109,
                    'longitude' => -47.0158,
                ],
                'telefone' => '11974414567'
            ],
            [
                'nome' => 'fernanda_teste',
                'regiao_usuario' => [
                    'cidade' => 'Vargem Grande Paulista',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5995,
                    'longitude' => -47.0357,
                ],
                'telefone' => '11912254567'
            ],
            [
                'nome' => 'rafael_teste',
                'regiao_usuario' => [
                    'cidade' => 'Vargem Grande Paulista',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.6167,
                    'longitude' => -47.0219,
                ],
                'telefone' => '119999864567'
            ],
            [
                'nome' => 'camila_teste',
                'regiao_usuario' => [
                    'cidade' => 'Vargem Grande Paulista',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5922,
                    'longitude' => -47.0127,
                ],
                'telefone' => '11901745667'
            ],
            [
                'nome' => 'bruno_teste',
                'regiao_usuario' => [
                    'cidade' => 'Itapevi',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5484,
                    'longitude' => -46.9345,
                ],
                'telefone' => '11901215767'
            ],
            [
                'nome' => 'beatriz_teste',
                'regiao_usuario' => [
                    'cidade' => 'Itapevi',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5517,
                    'longitude' => -46.9489,
                ],
                'telefone' => '11908456667'
            ],
            [
                'nome' => 'gabriel_teste',
                'regiao_usuario' => [
                    'cidade' => 'Itapevi',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5578,
                    'longitude' => -46.9402,
                ],
                'telefone' => '11987888567'
            ],
            [
                'nome' => 'leticia_teste',
                'regiao_usuario' => [
                    'cidade' => 'Itapevi',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5426,
                    'longitude' => -46.9541,
                ],
                'telefone' => '11901254769'
            ],
            [
                'nome' => 'felipe_teste',
                'regiao_usuario' => [
                    'cidade' => 'Itapevi',
                    'bairro' => 'teste',
                    'uf' => 'SP',
                    'latitude' => -23.5612,
                    'longitude' => -46.9298,
                ],
                'telefone' => '11901234117'
            ],
        ];

        foreach ($usuariosTeste as $usuarioTeste) {
            $usuarioExistente = User::where('name', $usuarioTeste['nome'])->first();

            if (!$usuarioExistente) {
                $usuarioModel = User::factory()->create([
                    'name' => $usuarioTeste['nome'],
                    'email' => $usuarioTeste['nome'] . '@mail.com',
                ]);

                $regiaoUsuario = RegiaoUsuario::create([
                    'cidade' => $usuarioTeste['regiao_usuario']['cidade'],
                    'bairro' => 'teste',
                    'uf' => $usuarioTeste['regiao_usuario']['uf'],
                    'latitude' => $usuarioTeste['regiao_usuario']['latitude'],
                    'longitude' => $usuarioTeste['regiao_usuario']['longitude'],
                ]);

                $usuarioModel->regiaoUsuario()->associate($regiaoUsuario);
                $usuarioModel->save();

                UsuarioTelefone::create([
                    'telefone' => $usuarioTeste['telefone'],
                    'user_id' => $usuarioModel->id,
                ]);
            }
        }
    }
}
