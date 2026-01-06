<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\SiswaSeeder;
use App\Models\Siswa;
use App\Models\User;

class SiswaSeedingTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_seeder_creates_users_and_links_user_id()
    {
        // Run only SiswaSeeder
        $this->seed(SiswaSeeder::class);

        $siswas = Siswa::all();
        $this->assertGreaterThan(0, $siswas->count());

        // For each siswa, ensure a user exists and user_id is set
        foreach ($siswas as $siswa) {
            $this->assertNotNull($siswa->user_id);
            $user = User::find($siswa->user_id);
            $this->assertNotNull($user);
            $this->assertEquals('siswa', $user->role);
            $this->assertEquals($siswa->email, $user->email);
        }
    }
}
