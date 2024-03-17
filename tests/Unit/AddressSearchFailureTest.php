<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressSearchFailureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para verificar se a busca de endereço por CEP retorna uma resposta de erro quando o CEP não existe.
     *
     * @return void
     */
    public function test_failed_address_search_by_nonexistent_cep()
    {
        // Criar um usuário de teste
        $user = User::factory()->create();

        // Autenticar o usuário
        $token = $user->createToken('')->plainTextToken;

        // Fazer uma requisição para buscar o endereço por um CEP inexistente
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/endereco/0a0a0a0a');

        // Verificar se a resposta está correta
        $response->assertStatus(404);
        $response->assertJson(['message' => 'CEP não encontrado']);
    }
}
