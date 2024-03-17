<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para verificar se o token de acesso é revogado corretamente ao fazer logout.
     *
     * @return void
     */
    public function test_access_token_revoked_on_logout()
    {
        // Criar um usuário de teste
        $user = User::factory()->create();

        // Autenticar o usuário e obter o token de acesso
        $token = $user->createToken('')->plainTextToken;

        // Fazer logout
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        // Verificar se o token de acesso foi revogado corretamente
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Token Revoked']);
    }
}
