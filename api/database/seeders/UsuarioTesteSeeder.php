<?php

namespace Database\Seeders;

use App\Models\Endereco;
use App\Models\Modulo;
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
                'endereco' => [
                    'cep' => '06700-000',
                    'logradouro' => 'Rua das Acacias',
                    'numero' => '125',
                    'complemento' => null,
                    'cidade' => 'Cotia',
                    'uf' => 'SP',
                    'latitude' => -23.6031,
                    'longitude' => -46.9182,
                ],
                'telefone' => '11901234567'
            ],
            [
                'nome' => 'maria_teste',
                'endereco' => [
                    'cep' => '06701-000',
                    'logradouro' => 'Rua dos Ipes',
                    'numero' => '42',
                    'complemento' => null,
                    'cidade' => 'Cotia',
                    'uf' => 'SP',
                    'latitude' => -23.5964,
                    'longitude' => -46.9229,
                ],
                'telefone' => '11901239874'
            ],
            [
                'nome' => 'pedro_teste',
                'endereco' => [
                    'cep' => '06702-000',
                    'logradouro' => 'Rua Primavera',
                    'numero' => '301',
                    'complemento' => 'Casa',
                    'cidade' => 'Cotia',
                    'uf' => 'SP',
                    'latitude' => -23.5897,
                    'longitude' => -46.9285,
                ],
                'telefone' => '11901232587'
            ],
            [
                'nome' => 'ana_teste',
                'endereco' => [
                    'cep' => '06703-000',
                    'logradouro' => 'Rua das Flores',
                    'numero' => '88',
                    'complemento' => null,
                    'cidade' => 'Cotia',
                    'uf' => 'SP',
                    'latitude' => -23.6105,
                    'longitude' => -46.9114,
                ],
                'telefone' => '11901237412'
            ],
            [
                'nome' => 'carlos_teste',
                'endereco' => [
                    'cep' => '06704-000',
                    'logradouro' => 'Rua dos Pinheiros',
                    'numero' => '517',
                    'complemento' => 'Apto 2',
                    'cidade' => 'Cotia',
                    'uf' => 'SP',
                    'latitude' => -23.6076,
                    'longitude' => -46.9361,
                ],
                'telefone' => '11901233652'
            ],
            [
                'nome' => 'julia_teste',
                'endereco' => [
                    'cep' => '06730-000',
                    'logradouro' => 'Rua Sao Pedro',
                    'numero' => '14',
                    'complemento' => null,
                    'cidade' => 'Vargem Grande Paulista',
                    'uf' => 'SP',
                    'latitude' => -23.6038,
                    'longitude' => -47.0271,
                ],
                'telefone' => '11978474567'
            ],
            [
                'nome' => 'lucas_teste',
                'endereco' => [
                    'cep' => '06731-000',
                    'logradouro' => 'Rua das Palmeiras',
                    'numero' => '225',
                    'complemento' => null,
                    'cidade' => 'Vargem Grande Paulista',
                    'uf' => 'SP',
                    'latitude' => -23.6109,
                    'longitude' => -47.0158,
                ],
                'telefone' => '11974414567'
            ],
            [
                'nome' => 'fernanda_teste',
                'endereco' => [
                    'cep' => '06732-000',
                    'logradouro' => 'Rua das Orquideas',
                    'numero' => '73',
                    'complemento' => null,
                    'cidade' => 'Vargem Grande Paulista',
                    'uf' => 'SP',
                    'latitude' => -23.5995,
                    'longitude' => -47.0357,
                ],
                'telefone' => '11912254567'
            ],
            [
                'nome' => 'rafael_teste',
                'endereco' => [
                    'cep' => '06733-000',
                    'logradouro' => 'Rua Santa Luzia',
                    'numero' => '91',
                    'complemento' => 'Fundos',
                    'cidade' => 'Vargem Grande Paulista',
                    'uf' => 'SP',
                    'latitude' => -23.6167,
                    'longitude' => -47.0219,
                ],
                'telefone' => '119999864567'
            ],
            [
                'nome' => 'camila_teste',
                'endereco' => [
                    'cep' => '06734-000',
                    'logradouro' => 'Rua dos Cedros',
                    'numero' => '310',
                    'complemento' => null,
                    'cidade' => 'Vargem Grande Paulista',
                    'uf' => 'SP',
                    'latitude' => -23.5922,
                    'longitude' => -47.0127,
                ],
                'telefone' => '11901745667'
            ],
            [
                'nome' => 'bruno_teste',
                'endereco' => [
                    'cep' => '06650-000',
                    'logradouro' => 'Rua Horizonte',
                    'numero' => '44',
                    'complemento' => null,
                    'cidade' => 'Itapevi',
                    'uf' => 'SP',
                    'latitude' => -23.5484,
                    'longitude' => -46.9345,
                ],
                'telefone' => '11901215767'
            ],
            [
                'nome' => 'beatriz_teste',
                'endereco' => [
                    'cep' => '06651-000',
                    'logradouro' => 'Rua das Violetas',
                    'numero' => '178',
                    'complemento' => null,
                    'cidade' => 'Itapevi',
                    'uf' => 'SP',
                    'latitude' => -23.5517,
                    'longitude' => -46.9489,
                ],
                'telefone' => '11908456667'
            ],
            [
                'nome' => 'gabriel_teste',
                'endereco' => [
                    'cep' => '06652-000',
                    'logradouro' => 'Rua Sao Joao',
                    'numero' => '12',
                    'complemento' => 'Casa 2',
                    'cidade' => 'Itapevi',
                    'uf' => 'SP',
                    'latitude' => -23.5578,
                    'longitude' => -46.9402,
                ],
                'telefone' => '11987888567'
            ],
            [
                'nome' => 'leticia_teste',
                'endereco' => [
                    'cep' => '06653-000',
                    'logradouro' => 'Rua das Margaridas',
                    'numero' => '265',
                    'complemento' => null,
                    'cidade' => 'Itapevi',
                    'uf' => 'SP',
                    'latitude' => -23.5426,
                    'longitude' => -46.9541,
                ],
                'telefone' => '11901254769'
            ],
            [
                'nome' => 'felipe_teste',
                'endereco' => [
                    'cep' => '06654-000',
                    'logradouro' => 'Rua Bela Vista',
                    'numero' => '98',
                    'complemento' => null,
                    'cidade' => 'Itapevi',
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

                $endereco = Endereco::create([
                    'cep' => $usuarioTeste['endereco']['cep'],
                    'logradouro' => $usuarioTeste['endereco']['logradouro'],
                    'numero' => $usuarioTeste['endereco']['numero'],
                    'complemento' => $usuarioTeste['endereco']['complemento'],
                    'cidade' => $usuarioTeste['endereco']['cidade'],
                    'uf' => $usuarioTeste['endereco']['uf'],
                    'latitude' => $usuarioTeste['endereco']['latitude'],
                    'longitude' => $usuarioTeste['endereco']['longitude'],
                ]);

                $usuarioModel->endereco()->associate($endereco);
                $usuarioModel->save();

                UsuarioTelefone::create([
                    'telefone' => $usuarioTeste['telefone'],
                    'user_id' => $usuarioModel->id,
                ]);
            }
        }
    }
}
