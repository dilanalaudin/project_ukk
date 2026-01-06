<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_welcome_and_register_pages()
    {
        // Ensure welcome is accessible
        $response = $this->get('/welcome');
        $response->assertStatus(200);

        // Ensure register page is accessible
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_guest_can_register_and_is_redirected_to_dashboard()
    {
        $response = $this->followingRedirects()->post('/register', [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user123',
            'password_confirmation' => 'user123',
        ]);
        $response->assertStatus(200);
        $response->assertSeeText('Halo Siswa');
        $this->assertDatabaseHas('users', ['email' => 'user@gmail.com', 'role' => 'siswa']);
        $this->assertAuthenticated();
    }

    public function test_siswa_user_login_redirects_to_siswa_dashboard()
    {
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role' => 'siswa',
        ]);

        $response = $this->followingRedirects()->post('/login', [
            'email' => $user->email,
            'password' => 'user123',
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Dashboard - Siswa');
        $this->assertAuthenticatedAs($user);
    }
}
