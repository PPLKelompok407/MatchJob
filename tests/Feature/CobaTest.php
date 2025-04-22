<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CobaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // Buat user testing
        $user = User::factory()->create();

        // Login sebagai user testing
        $this->actingAs($user);

        $response = $this->get('/profile/personal');

        $response->assertStatus(200);
    }
}
