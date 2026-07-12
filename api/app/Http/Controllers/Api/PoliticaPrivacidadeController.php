<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoliticaPrivacidade;
use Illuminate\Http\Request;

class PoliticaPrivacidadeController extends Controller
{
    public function atual () {
        try {
            $politicaPrivacidade = PoliticaPrivacidade::orderBy('id', 'desc')->first();
            $politicaPrivacidade->dataCriacaoPtBr = date('d/m/Y', strtotime($politicaPrivacidade->created_at)) . ', às ' . date('H:i', strtotime($politicaPrivacidade->created_at));
            
            return response()->json($politicaPrivacidade);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}