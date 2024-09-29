<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class InfoControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_php_version()
    {
        $response = $this->get('/info/server');

        $response->assertStatus(200)
                 ->assertJsonStructure(['php_version']);
    }

    #[Test]
    public function it_returns_client_info()
    {
        $response = $this->get('/info/client', [
            'User-Agent' => 'TestAgent'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['ip', 'user_agent'])
                 ->assertJson(['user_agent' => 'TestAgent']);
    }

    #[Test]
    public function it_returns_database_info()
    {
        $response = $this->get('/info/database');

        $response->assertStatus(200)
                 ->assertJsonStructure(['database']);
    }
}

