<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate(); // удалить предыдущие записи перед созданием новых пользователей
        User::create([
            'name' => 'admin',
            'email' => 'admin2@gmail.com',
            // 'email' => 'admin@gmail.com',
            // 'password' => 12345678,
            'password' => Hash::make('123456789'),
            'is_admin' => true,
        ]);
    }
}
