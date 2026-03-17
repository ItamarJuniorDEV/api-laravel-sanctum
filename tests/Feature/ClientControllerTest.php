<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    private function token(array $abilities = ['clients:list', 'clients:detail']): string
    {
        $user = User::factory()->create();

        return $user->createToken('test', $abilities)->plainTextToken;
    }

    public function test_lista_clientes_com_sucesso(): void
    {
        Client::factory()->count(3)->create();

        $response = $this->withToken($this->token())->getJson('/api/clients');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['clients', 'total', 'current_page', 'last_page']]);
    }

    public function test_lista_clientes_sem_ability_retorna_401(): void
    {
        $response = $this->withToken($this->token(['clients:detail']))->getJson('/api/clients');

        $response->assertStatus(401);
    }

    public function test_cria_cliente_com_sucesso(): void
    {
        $response = $this->withToken($this->token())->postJson('/api/clients', [
            'name' => 'João Silva',
            'email' => 'joao@teste.com',
            'phone' => '11999999999',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', ['email' => 'joao@teste.com']);
    }

    public function test_cria_cliente_sem_ability_retorna_401(): void
    {
        $response = $this->withToken($this->token(['clients:list']))->postJson('/api/clients', [
            'name' => 'João Silva',
            'email' => 'joao@teste.com',
            'phone' => '11999999999',
        ]);

        $response->assertStatus(401);
    }

    public function test_cria_cliente_com_dados_invalidos_retorna_422(): void
    {
        $response = $this->withToken($this->token())->postJson('/api/clients', []);

        $response->assertStatus(422);
    }

    public function test_exibe_cliente_com_sucesso(): void
    {
        $client = Client::factory()->create();

        $response = $this->withToken($this->token())->getJson('/api/clients/'.$client->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.email', $client->email);
    }

    public function test_exibe_cliente_inexistente_retorna_404(): void
    {
        $response = $this->withToken($this->token())->getJson('/api/clients/999');

        $response->assertStatus(404);
    }

    public function test_atualiza_cliente_com_sucesso(): void
    {
        $client = Client::factory()->create();

        $response = $this->withToken($this->token())->putJson('/api/clients/'.$client->id, [
            'name' => 'Nome Atualizado',
            'email' => $client->email,
            'phone' => '11888888888',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', ['id' => $client->id, 'phone' => '11888888888']);
    }

    public function test_atualiza_cliente_inexistente_retorna_404(): void
    {
        $response = $this->withToken($this->token())->putJson('/api/clients/999', [
            'name' => 'Nome',
            'email' => 'teste@teste.com',
            'phone' => '11999999999',
        ]);

        $response->assertStatus(404);
    }

    public function test_deleta_cliente_com_sucesso(): void
    {
        $client = Client::factory()->create();

        $response = $this->withToken($this->token())->deleteJson('/api/clients/'.$client->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }

    public function test_deleta_cliente_inexistente_retorna_404(): void
    {
        $response = $this->withToken($this->token())->deleteJson('/api/clients/999');

        $response->assertStatus(404);
    }
}
