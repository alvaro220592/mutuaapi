<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modulos = [
            [
                'nome' => 'Doações',
                'slug' => 'doacoes',
                'descricao' => 'Se você precisa de ajuda ou quer ajudar',
                'icone' => 'volunteer_activism',
                'ordem_exibicao' => 1,
                'ativo' => true,
            ],
            [
                'nome' => 'Adoção de animais',
                'slug' => 'adocao-animais',
                'descricao' => 'Adote ou divulgue para adoção',
                'icone' => 'pets',
                'ordem_exibicao' => 2,
                'ativo' => false, // por enquanto
            ],
            [
                'nome' => 'Pessoas desaparecidas',
                'slug' => 'pessoas-desaparecidas',
                'descricao' => 'Uma pessoa desapareceu ou foi encontrada',
                'icone' => 'person_search',
                'ordem_exibicao' => 3,
                'ativo' => false, // por enquanto
            ],
            [
                'nome' => 'Animais desaparecidos',
                'slug' => 'animais-esaparecidos',
                'descricao' => 'Um animal desapareceu ou foi encontrado',
                'icone' => 'report',
                'ordem_exibicao' => 4,
                'ativo' => false, // por enquanto
            ],
        ];

        foreach($modulos as $modulo){
            if (!Modulo::where('nome', $modulo['nome'])->first()) {
                Modulo::create([
                    'nome' => $modulo['nome'],
                    'slug' => $modulo['slug'],
                    'descricao' => $modulo['descricao'],
                    'icone' => $modulo['icone'],
                    'ordem_exibicao' => $modulo['ordem_exibicao'],
                    'ativo' => $modulo['ativo'],
                ]);
            }
        }
    }
}
