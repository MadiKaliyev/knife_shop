<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => '1910797@mail.ru',
            'password' => Hash::make('12345678'), // Важно: пароль хешируется
            'role' => 'admin',
        ]);
    }
}
