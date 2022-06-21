<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class in extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 100; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('ins')->insert([
                'nm_brg' => $faker->randomElement(['Cumi','Tengiri','Gurita','Cakalang','Bekutak','Pancingan','Banyar']),
                'jns_brg' => $faker->randomElement(['Besar','Kecil','Rusak','Bagus','Merah','Pancing','Biasa']),
                'jumlah' => $faker->randomElement(['100000','243345','211343']),
                'tanggal' => $faker->randomElement(['23/02/21']),
                'hrg_item' => $faker->randomElement(['10000','15500','23000'])
    		]);
 
    	}
    }
}
