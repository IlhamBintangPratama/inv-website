<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Staff Purchase',
            'username' => 'user@multi-auth.test',
            'password' => bcrypt(12345678),
            'level' => '2',
            'email' => 'admin@admin',
        ]);
    }
}
