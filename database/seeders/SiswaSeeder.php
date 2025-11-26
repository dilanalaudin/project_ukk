<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Siswa;


class SiswaSeeder extends Seeder
{
public function run()
{
Siswa::factory()->count(30)->create();
}
}