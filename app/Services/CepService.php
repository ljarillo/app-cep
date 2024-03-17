<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CepService
{
    public function getAddressByCep($cep)
    {
        // Faz a requisição para a API do ViaCEP
        $response = Http::get("https://viacep.com.br/ws/$cep/json/");

        // Verifica se a requisição foi bem-sucedida
        if ($response->ok()) {
            $data = $response->json();
            return response()->json([
                'cep' => $data['cep'] ?? null,
                'logradouro' => $data['logradouro'] ?? null,
                'complemento' => $data['complemento'] ?? null,
                'bairro' => $data['bairro'] ?? null,
                'localidade' => $data['localidade'] ?? null,
                'uf' => $data['uf'] ?? null
            ]);
        } else {
            return response()->json(['message' => 'CEP não encontrado'], 404);
        }
    }
}