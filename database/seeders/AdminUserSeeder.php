<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@bk.com'],
            [
                'name' => 'AdminBK',
                'password' => Hash::make('password'),
                'role' => 'admin', // pastikan kolom role ada di migration users
            ]
        );
    }
}