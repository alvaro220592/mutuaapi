<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PerfilAcessoSeeder::class);

        $nomeAdmin = 'alvaro';
        $emailAdmin = 'alvaro220592@gmail.com';

        if (!User::where(['name' => $nomeAdmin, 'email' => $emailAdmin])->first()) {
            $usuario = User::factory()->create([
                'name' => $nomeAdmin,
                'email' => $emailAdmin,
            ]);

            $usuario->assignRole('admin');
        }

        $this->call(ModuloSeeder::class);
        $this->call(CategoriaDoacaoSeeder::class);
        $this->call(PerfilDoacaoSeeder::class);
        $this->call(UsuarioTesteSeeder::class);
        $this->call(PoliticaPrivacidadeSeeder::class);
    }
}
