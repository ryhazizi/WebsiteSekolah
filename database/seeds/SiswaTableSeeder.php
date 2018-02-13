<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create();

        for ($i=0; $i <= 30; $i++) { 
        	
        	DB::table('siswa')->insert([
            	'nama'     => $faker->name,
            	'noabsen'  => rand(01, 30),
            	'kelas'    => //isi dengan nilai kelas yg dituju contoh : "XI RPL 1"
        	]);
     
        }
    }
}
