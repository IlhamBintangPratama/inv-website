<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
   
        public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@multi-auth.test',
            'password' => bcrypt(12345678),
        ]);
    }
}
