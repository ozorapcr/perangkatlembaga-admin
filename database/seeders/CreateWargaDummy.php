<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'nama'   => $faker->name,
                'nik'    => $faker->unique()->numerify('####################'), // 20 digit
                'alamat' => $faker->address,
                'no_hp'  => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
