<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para verificar se uma requisição para a rota /endereco/{cep} com um token de autenticação
     * válido retorna os dados do endereço corretamente.
     *
     * @return void
     */
    public function test_authorized_access_to_address_route_with_valid_authentication()
    {
        // Criar um usuário de teste
        $user = User::factory()->create();

        // Autenticar o usuário
        $token = $user->createToken('')->plainTextToken;

        // Fazer uma requisição para a rota com o token de autenticação válido
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/endereco/01001000');

        // Verificar se a resposta está correta
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'cep',
            'logradouro',
            'complemento',
            'bairro',
            'localidade',
            'uf'
        ]);
    }
}
