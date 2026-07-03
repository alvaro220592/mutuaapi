<?php

namespace Database\Seeders;

use App\Models\Doacao\CategoriaDoacao;
use App\Models\Doacao\PerfilDoacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PerfilAcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomes = ['admin'];

        foreach($nomes as $nome){
            $registroEXistente = Role::where('name', $nome)->first();

            if (!$registroEXistente) {
                Role::create([
                    'name' => $nome,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
