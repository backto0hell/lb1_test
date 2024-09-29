<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class InfoControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_php_version() // Отправляем get-запрос на маршрут /info/server и проверяем, что ответ имеет статутс 200 и имеет json-стрктуру с ключом php_version
    {
        $response = $this->get('/info/server');

        $response->assertStatus(200)
                 ->assertJsonStructure(['php_version']);
    }

    #[Test]
    public function it_returns_client_info()// Отправляем get-запрос на маршрут /info/client и проверяем, что ответ имеет статутс 200 и имеет json-стрктуру с ключом ip и user_agent, а также user_agent = TestAgent
    {
        $response = $this->get('/info/client', [
            'User-Agent' => 'TestAgent'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['ip', 'user_agent'])
                 ->assertJson(['user_agent' => 'TestAgent']);
    }

    #[Test]
    public function it_returns_database_info() // Отправляем get-запрос на маршрут /info/database и проверяем, что ответ имеет статутс 200 и имеет json-стрктуру с ключом database
    {
        $response = $this->get('/info/database');

        $response->assertStatus(200)
                 ->assertJsonStructure(['database']);
    }
}

