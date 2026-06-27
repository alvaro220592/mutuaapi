<?php

namespace Database\Seeders;

use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\PerfilDoacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilDoacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomes = ['oferecida', 'solicitada'];

        foreach($nomes as $nome){
            $registroEXistente = PerfilDoacao::where(['nome', $nome])->first();

            if (!$registroEXistente) {
                PerfilDoacao::create([
                    'nome' => $nome
                ]);
            }
        }
    }
}
