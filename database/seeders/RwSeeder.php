<?php

namespace Database\Seeders;

use App\Models\Rw;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk menghindari error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rw::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create('id_ID');

        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'nomorRw' => 'RW' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketuaRwWargaId' => $faker->numberBetween(1, 500), // Semua diisi
                'keterangan' => $faker->sentence(6), // Semua diisi
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Insert setiap 20 data untuk menghindari memory limit
            if ($i % 20 === 0) {
                Rw::insert($data);
                $data = [];
            }
        }

        // Insert sisa data jika ada
        if (!empty($data)) {
            Rw::insert($data);
        }
    }
}