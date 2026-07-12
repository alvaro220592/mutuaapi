<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermoUso;
use Illuminate\Http\Request;

class TermoUsoController extends Controller
{
    public function atual () {
        try {
            $termoUso = TermoUso::orderBy('id', 'desc')->first();
            $termoUso->dataCriacaoPtBr = date('d/m/Y', strtotime($termoUso->created_at)) . ', às ' . date('H:i', strtotime($termoUso->created_at));
            
            return response()->json($termoUso);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}