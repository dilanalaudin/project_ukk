<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Konseling;

class SiswaPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_can_view_jadwal_and_notes()
    {
        $siswa = Siswa::factory()->create();
        $user = User::factory()->create(['email' => $siswa->email, 'role' => 'siswa']);
        $siswa->user_id = $user->id;
        $siswa->save();

        // create some jadwal and konseling records
        // create jadwal using Konseling table with type 'jadwal'
        \App\Models\Konseling::create(['siswa_id' => $siswa->id, 'tanggal' => now()->addDays(1), 'jenis' => 'Konseling', 'keterangan' => 'Test jadwal', 'type' => \App\Models\Konseling::TYPE_JADWAL]);
        Konseling::create(['siswa_id' => $siswa->id, 'tanggal' => now()->subDays(1), 'jenis' => 'Bimbingan', 'keterangan' => 'Test catatan', 'type' => Konseling::TYPE_NOTE]);

        $this->actingAs($user);

        $response = $this->get(route('siswa.jadwals.index'));
        $response->assertStatus(200);
        $response->assertSee('Test jadwal');

        $response = $this->get(route('siswa.notes.index'));
        $response->assertStatus(200);
        $response->assertSee('Test catatan');
    }
}
