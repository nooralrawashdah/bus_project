<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Noor Hasan',
            'email' => 'noor@gmail.com',
            'password' => bcrypt('password123'),
            'Address' => 'Amman'
        ]);
    }
}
