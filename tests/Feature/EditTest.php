<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_edit(): void
    {
        // Buat user testing
        $user = User::factory()->create();
        
        // Login sebagai user testing
        $this->actingAs($user);

        // Akses endpoint yang dilindungi oleh middleware auth
        $response = $this->get('/profile/edit');
        
        $response->assertStatus(200);
    }
}
