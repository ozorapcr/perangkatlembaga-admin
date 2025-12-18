<?php
// database/seeders/JabatanLembagaSeeder.php

namespace Database\Seeders;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Database\Seeder;

class JabatanLembagaSeeder extends Seeder
{
    public function run()
    {
        // Ambil beberapa lembaga yang sudah ada
        $lembagas = LembagaDesa::take(5)->get();
        
        if ($lembagas->isEmpty()) {
            $this->command->info('Tidak ada data LembagaDesa. Silakan run LembagaDesaSeeder terlebih dahulu.');
            return;
        }

        $jabatanData = [
            [
                'nama_jabatan' => 'Ketua',
                'level' => 1,
            ],
            [
                'nama_jabatan' => 'Wakil Ketua',
                'level' => 2,
            ],
            [
                'nama_jabatan' => 'Sekretaris',
                'level' => 3,
            ],
            [
                'nama_jabatan' => 'Bendahara',
                'level' => 4,
            ],
            [
                'nama_jabatan' => 'Anggota',
                'level' => 5,
            ],
            [
                'nama_jabatan' => 'Koordinator',
                'level' => 2,
            ],
            [
                'nama_jabatan' => 'Wakil Sekretaris',
                'level' => 4,
            ],
            [
                'nama_jabatan' => 'Wakil Bendahara',
                'level' => 5,
            ],
            [
                'nama_jabatan' => 'Ketua Bidang',
                'level' => 3,
            ],
            [
                'nama_jabatan' => 'Anggota Bidang',
                'level' => 6,
            ],
        ];

        $jabatans = [];
        $lembagaIndex = 0;

        foreach ($jabatanData as $data) {
            $jabatans[] = [
                'lembaga_id' => $lembagas[$lembagaIndex]->lembaga_id,
                'nama_jabatan' => $data['nama_jabatan'],
                'level' => $data['level'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Pindah ke lembaga berikutnya secara bergantian
            $lembagaIndex = ($lembagaIndex + 1) % count($lembagas);
        }

        JabatanLembaga::insert($jabatans);

        $this->command->info('JabatanLembagaSeeder berhasil dijalankan!');
        $this->command->info('Total data: ' . count($jabatans));
    }
}