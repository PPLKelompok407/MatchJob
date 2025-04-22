<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AnalysTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_analys(): void
    {
        // Buat user testing
        $user = User::factory()->create();
        
        // Login sebagai user testing
        $this->actingAs($user);

        // Akses endpoint yang dilindungi oleh middleware auth
        $response = $this->get('/profile/analys');
        
        $response->assertStatus(200);
    }
}
