<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para verificar se a busca de endereço por CEP retorna os dados corretos quando o CEP existe.
     *
     * @return void
     */
    public function test_successful_address_search_by_cep()
    {
        // Criar um usuário de teste
        $user = User::factory()->create();

        // Autenticar o usuário
        $token = $user->createToken('')->plainTextToken;

        // Fazer uma requisição para buscar o endereço pelo CEP existente
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/endereco/01001000');

        // Verificar se a resposta está correta
        $response->assertStatus(200);
        $response->assertJson([
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'complemento' => 'lado ímpar',
            'bairro' => 'Sé',
            'localidade' => 'São Paulo',
            'uf' => 'SP'
        ]);
    }
}
