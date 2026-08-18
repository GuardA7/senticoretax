<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_manual_input_route_uses_https_when_running_under_https_proxy(): void
    {
        config(['app.url' => 'https://senticoretax-production.up.railway.app']);

        $url = route('manual.input');

        $this->assertStringStartsWith('https://', $url);
    }
}
