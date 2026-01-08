<?php
// database/seeders/AnggotaLembagaSeeder.php

namespace Database\Seeders;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\Warga;
use App\Models\JabatanLembaga;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnggotaLembagaSeeder extends Seeder
{
    public function run()
    {
        // Ambil data yang diperlukan
        $lembagas = Lembaga::all();
        $wargas = Warga::take(20)->get(); // Ambil 20 warga pertama
        $jabatans = JabatanLembaga::all();

        if ($lembagas->isEmpty() || $wargas->isEmpty() || $jabatans->isEmpty()) {
            $this->command->info('Data LembagaDesa, Warga, atau JabatanLembaga tidak ditemukan!');
            $this->command->info('Pastikan seeder untuk tabel-tabel tersebut sudah dijalankan.');
            return;
        }

        $anggotaData = [];
        $wargaIndex = 0;
        $jabatanIndex = 0;

        // Buat data untuk setiap lembaga
        foreach ($lembagas as $lembaga) {
            // Tentukan berapa banyak anggota untuk lembaga ini (3-7 anggota)
            $jumlahAnggota = rand(3, 7);

            for ($i = 0; $i < $jumlahAnggota; $i++) {
                if ($wargaIndex >= count($wargas)) {
                    $wargaIndex = 0; // Reset jika sudah habis
                }

                if ($jabatanIndex >= count($jabatans)) {
                    $jabatanIndex = 0; // Reset jika sudah habis
                }

                $warga = $wargas[$wargaIndex];
                $jabatan = $jabatans[$jabatanIndex];

                // Tentukan tanggal mulai (1-2 tahun yang lalu)
                $tglMulai = Carbon::now()->subYears(rand(1, 2))->subDays(rand(0, 365));

                // 70% anggota aktif, 30% non aktif
                $isAktif = rand(1, 10) <= 7;

                if ($isAktif) {
                    $tglSelesai = null; // Masih aktif
                } else {
                    // Anggota non aktif, tanggal selesai 1-12 bulan yang lalu
                    $tglSelesai = $tglMulai->copy()->addMonths(rand(6, 24));
                }

                // Pastikan tanggal selesai tidak lebih kecil dari tanggal mulai
                if ($tglSelesai && $tglSelesai->lessThan($tglMulai)) {
                    $tglSelesai = $tglMulai->copy()->addMonths(rand(1, 12));
                }

                $anggotaData[] = [
                    'lembaga_id' => $lembaga->lembaga_id,
                    'warga_id' => $warga->id,
                    'jabatan_id' => $jabatan->jabatan_id,
                    'tgl_mulai' => $tglMulai->format('Y-m-d'),
                    'tgl_selesai' => $tglSelesai ? $tglSelesai->format('Y-m-d') : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $wargaIndex++;
                $jabatanIndex++;
            }
        }

        // Insert data dalam batch
        foreach (array_chunk($anggotaData, 100) as $chunk) {
            AnggotaLembaga::insert($chunk);
        }

        $this->command->info('AnggotaLembagaSeeder berhasil dijalankan!');
        $this->command->info('Total data anggota lembaga: ' . count($anggotaData));

        // Hitung statistik
        $totalAktif = AnggotaLembaga::aktif()->count();
        $totalNonAktif = AnggotaLembaga::nonAktif()->count();

        $this->command->info('Anggota aktif: ' . $totalAktif);
        $this->command->info('Anggota non aktif: ' . $totalNonAktif);
    }
}
