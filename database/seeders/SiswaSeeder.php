<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SiswaSeeder extends Seeder
{
public function run()
{
	// Buat siswas menggunakan factory
	$siswas = Siswa::factory()->count(30)->create();

	// Untuk setiap siswa, buat akun user dengan role 'siswa' dan hubungkan via user_id
	foreach ($siswas as $siswa) {
		if ($siswa->email) {
			$user = User::firstOrCreate(
				['email' => $siswa->email],
				[
					'name' => $siswa->nama_lengkap,
					'email' => $siswa->email,
					'password' => Hash::make('password'),
					'role' => 'siswa',
				]
			);

			// update user_id pada record siswa jika belum terisi
			if (! $siswa->user_id) {
				$siswa->user_id = $user->id;
				$siswa->save();
			}
		}
	}
}
}