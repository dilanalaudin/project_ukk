<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder tambahan
        $this->call([
            \Database\Seeders\AdminUserSeeder::class,
            \Database\Seeders\SiswaSeeder::class,
        ]);
    }
}