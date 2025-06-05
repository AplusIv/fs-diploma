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
        // удалить предыдущие записи перед созданием новых пользователей
        User::truncate();
        
        // 1)
        User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            // 'email' => 'admin2@gmail.com',
            // 'password' => 123456789,
            'password' => Hash::make('123456789'),
            'is_admin' => true,
        ]);

        // 2)
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => true,
        ]);

        // 3) пользовать без прав администратора
        User::create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => false,
        ]);
    }
}
