<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'nis' => $this->faker->unique()->numerify('########'),
            'nama_lengkap' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'jurusan' => $this->faker->randomElement(['RPL', 'TKR', 'TPM', 'TITL']),
            'email' => $this->faker->unique()->safeEmail(),
            'no_hp' => $this->faker->phoneNumber(),
            'tgl_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'wali_kelas' => null,
            'status' => $this->faker->randomElement(['aktif', 'lulus', 'nonaktif']),
        ];
    }
}
