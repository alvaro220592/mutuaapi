<?php

namespace App\Http\Controllers\Api\Doacao;

use App\Http\Controllers\Controller;
use App\Models\Doacao\CategoriaDoacao;
use Illuminate\Http\Request;

class CategoriaDoacaoController extends Controller
{
    public function index () {
        try {
            $categorias = CategoriaDoacao::where('ativo', 1)->get();
            
            return response()->json([
                'categorias' => $categorias,
                'categoriaOutrosId' => CategoriaDoacao::ID_OUTROS,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}