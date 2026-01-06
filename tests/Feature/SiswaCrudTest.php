<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_siswa()
    {
        // buat admin
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin);

        // create
        $response = $this->post(route('admin.siswas.store'), [
            'nis' => '00012345',
            'nama_lengkap' => 'Test Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'email' => 'siswa@test.local',
            'alamat' => 'Test address 123',
            'no_hp' => '0812345678',
            'tgl_lahir' => '2006-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect(route('admin.siswas.index'));
        $this->assertDatabaseHas('siswas', ['nis' => '00012345', 'nama_lengkap' => 'Test Siswa', 'alamat' => 'Test address 123']);

        $siswa = Siswa::where('nis', '00012345')->first();

        // update
        $response = $this->put(route('admin.siswas.update', $siswa), [
            'nis' => '00012345',
            'nama_lengkap' => 'Siswa Updated',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'email' => 'siswa@test.local',
            'alamat' => 'Updated address 456',
            'no_hp' => '0812345678',
            'tgl_lahir' => '2006-01-02',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect(route('admin.siswas.index'));
        $this->assertDatabaseHas('siswas', ['nis' => '00012345', 'nama_lengkap' => 'Siswa Updated', 'alamat' => 'Updated address 456']);

        // delete
        $response = $this->delete(route('admin.siswas.destroy', $siswa));
        $response->assertRedirect(route('admin.siswas.index'));
        $this->assertDatabaseMissing('siswas', ['nis' => '00012345']);
    }

    public function test_admin_can_view_index_and_show()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $siswa = Siswa::factory()->create();

        $this->actingAs($admin);
        $response = $this->get(route('admin.siswas.index'));
        $response->assertStatus(200);
        $response->assertSee($siswa->nama_lengkap);

        $response = $this->get(route('admin.siswas.show', $siswa));
        $response->assertStatus(200);
        $response->assertSee($siswa->nis);
    }

    public function test_admin_dashboard_total_updates_after_add_siswa()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $initialCount = Siswa::count();

        // Create a new siswa
        $response = $this->post(route('admin.siswas.store'), [
            'nis' => '111222333',
            'nama_lengkap' => 'Dashboard Test Siswa',
            'kelas' => 'XI',
            'jurusan' => 'IPA',
            'email' => 'dash@test.local',
            'alamat' => 'Addr 1',
            'no_hp' => '0811112222',
            'tgl_lahir' => '2007-02-02',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect(route('admin.siswas.index'));

        $newCount = Siswa::count();
        $this->assertEquals($initialCount + 1, $newCount);

        // visit admin dashboard and check it shows the updated count
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSeeText((string) $newCount);
    }

    public function test_non_admin_cannot_create_siswa()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $this->actingAs($user);

        $response = $this->post(route('admin.siswas.store'), [
            'nis' => '99988877',
            'nama_lengkap' => 'Should Not Create',
            'kelas' => 'X',
        ]);

        $response->assertStatus(403);
    }
}
