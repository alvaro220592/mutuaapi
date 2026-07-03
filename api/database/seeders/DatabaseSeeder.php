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
        $nomeAdmin = 'alvaro';
        $emailAdmin = 'alvaro220592@gmail.com';

        if (!User::where(['name' => $nomeAdmin, 'email' => $emailAdmin])->first()) {
            User::factory()->create([
                'name' => $nomeAdmin,
                'email' => $emailAdmin,
            ]);
        }

        $this->call(ModuloSeeder::class);
        $this->call(CategoriaDoacaoSeeder::class);
        $this->call(PerfilDoacaoSeeder::class);
        $this->call(UsuarioTesteSeeder::class);
    }
}
