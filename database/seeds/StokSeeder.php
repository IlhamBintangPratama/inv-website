<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 6; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('stoks')->insert([
                'nm_brg' => $faker->randomElement(['Cumi','Cendol','Gurita','Semampar','Bekutak','Pancingan']),
                'jns_brg' => $faker->randomElement(['BB','BT','BK','B1','B2','J1','J2']),
                'stok' => $faker->randomElement(['100000','243345','211343']),
                'tanggal' => $faker->randomElement(['2021/02/03']),
    		]);
 
    	}
    }
}
