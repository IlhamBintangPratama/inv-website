<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            // 'username' => 'bbkgoreng72@gmail.com',
            'password' => Hash::make('123123'),
            'level' => '3',
            'email' => 'bbkgoreng72@gmail.com',
        ]);
    }
}

