<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_empty_request(): void
    {
        $response = $this->json('POST', '/api/submit', []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => [
                'name',
                'email',
                'message'
            ]
        ]);
    }

    public function test_invalid_email(): void
    {
        $response = $this->json('POST', '/api/submit', [
            'name' => 'John Dow',
            'email' => 'test',
            'message' => 'some message here.'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message'  => "Field 'Email' should be a valid email address."
        ]);

        $response->assertJsonStructure([
            'errors' => [
                'email'
            ]
        ]);
    }

    public function test_success(): void
    {
        $response = $this->json('POST', '/api/submit', [
            'name' => 'John Dow',
            'email' => 'test@test.com',
            'message' => 'some message here.'
        ]);

        $response->assertStatus(200);
    }
}
