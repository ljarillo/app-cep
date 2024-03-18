<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Teste para verificar se é possível autenticar um usuário com credenciais válidas.
     *
     * @return void
     */
    public function test_successful_authentication(): void
    {
        // Criar um usuário de teste
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Considerando que a senha é "password"
        ]);

        // Tentar autenticar o usuário
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password', // Tentando fazer login com a senha correta
        ]);

        // Verificar se a resposta está correta
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
        
        // Verificar se o token de acesso foi retornado corretamente
        $token = $response->json('token');
    }

    /**
     * Teste para verificar se a autenticação falha com credenciais inválidas.
     *
     * @return void
     */
    public function test_failed_authentication()
    {
        // Criar um usuário de teste com senha válida
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Considerando que a senha é "password"
        ]);

        // Tentar autenticar o usuário com credenciais inválidas
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'senha_incorreta', // Tentando fazer login com senha incorreta
        ]);

        // Verificar se a resposta está correta
        $response->assertStatus(403);
        $response->assertJson(['message' => 'Unauthorized']);
    }

    /**
     * Teste para verificar se uma requisição para a rota /endereco/{cep} sem um token de autenticação
     * retorna corretamente um status de erro 401 ou 403.
     *
     * @return void
     */
    public function test_unauthorized_access_to_route_without_authentication()
    {
        // Faz uma requisição para a rota sem um token de autenticação
        $response = $this->getJson('/api/endereco/01001000');

        // Verifica se a resposta está correta
        $response->assertStatus(401)->assertJson(['message' => 'Unauthenticated.']);
    }
}

