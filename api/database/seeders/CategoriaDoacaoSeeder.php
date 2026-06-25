<?php

namespace Database\Seeders;

use App\Models\Doacao\CategoriaDoacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaDoacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomesCategorias = [
            "Alimentos",
            "Roupas e calçados",
            "Móveis",
            "Brinquedos",
            "Materiais escolares",
            "Eletrônicos",
            "Eletrodomésticos",
            "Produtos de higiene",
            "Itens para bebês",
            "Medicamentos e materiais médicos",
            "Itens para animais",
            "Ferramentas",
            "Livros",
            "Artigos esportivos",
            "Outros"
        ];

        foreach($nomesCategorias as $nome){
            $categoriaEXistente = CategoriaDoacao::where(['nome', $nome])->first();

            if (!$categoriaEXistente) {
                CategoriaDoacao::create([
                    'nome' => $nome
                ]);
            }
        }
    }
}
