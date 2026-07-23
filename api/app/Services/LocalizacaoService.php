<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LocalizacaoService
{
    public function buscarRegiaoPeloCep ($cep) {
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json/");
        $dados = $resposta->json();

        if (!empty($dados['erro'])) {
            \Log::info('Erro: ' . $dados['erro']);
            return null;
        }

        return $dados;
    }

    public function coordenadasPeloEndereco(string $address): ?array
    {
        $resposta = Http::get('https://nominatim.openstreetmap.org/search', [
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
        ]);

        $dados = $resposta->json();

        if (!isset($dados[0])) {
            return null;
        }

        return [
            'latitude' => $dados[0]['lat'],
            'longitude' => $dados[0]['lon'],
        ];
    }
}