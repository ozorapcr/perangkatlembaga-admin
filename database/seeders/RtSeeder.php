<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rt;
use App\Models\Rw;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data RW terlebih dahulu
        if (Rw::count() === 0) {
            $this->call(RwSeeder::class); // Jika belum ada, jalankan seeder RW
        }

        // Ambil semua data RW
        $rws = Rw::all();
        
        // Data dummy RT
        $rtData = [];
        
        foreach ($rws as $rw) {
            // Setiap RW memiliki 5 RT (nomor 001 sampai 005)
            for ($i = 1; $i <= 5; $i++) {
                $rtNumber = str_pad($i, 3, '0', STR_PAD_LEFT);
                
                $rtData[] = [
                    'rw_id' => $rw->id,
                    'nomor_rt' => $rtNumber,
                    'ketua_rt_warga_id' => null, // Kosong dulu, nanti diisi manual
                    'keterangan' => "RT $rtNumber di RW {$rw->nomorRw}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert data RT
        Rt::insert($rtData);
        
        $this->command->info('Seeder RT berhasil dijalankan!');
        $this->command->info('Total RT yang dibuat: ' . count($rtData));
    }
}