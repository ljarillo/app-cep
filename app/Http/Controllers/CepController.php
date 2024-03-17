<?php

namespace App\Http\Controllers;

use App\Services\CepService;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function getAddress($cep)
    {
        try {
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
                return response()->json(['error' => 'CEP não encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao processar a requisição'], 500);
        }
    }
}
