<?php

namespace App\Http\Controllers;

use App\Services\CepService;

class CepController extends Controller
{
    protected $cepService;

    public function __construct(CepService $cepService)
    {
        $this->cepService = $cepService;
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
