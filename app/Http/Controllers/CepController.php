<?php

namespace App\Http\Controllers;

use App\Services\CepService;

class CepController extends Controller
{
    public function __construct(protected CepService $cepService)
    {
    }


    public function getAddress($cep)
    {
        try {
            return $this->cepService->getAddressByCep($cep);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao processar a requisição'], 500);
        }
    }
}
