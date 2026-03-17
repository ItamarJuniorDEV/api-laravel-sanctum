<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_sem_dados_retorna_422(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
    }

    public function test_login_com_credenciais_invalidas_retorna_401(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'naoexiste@teste.com',
            'password' => 'senhaerrada',
        ]);

        $response->assertStatus(401);
    }
}
