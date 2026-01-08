<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LembagaDesa;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear tabel jika ada data sebelumnya
        LembagaDesa::truncate();

        // Data dummy Lembaga Desa
        $lembagaData = [
            // Lembaga Formal Desa
            [
                'nama_lembaga' => 'Badan Permusyawaratan Desa (BPD)',
                'deskripsi' => 'Lembaga yang merupakan perwujudan demokrasi dalam penyelenggaraan pemerintahan desa. Bertugas membantu kepala desa dalam membuat peraturan desa dan menampung aspirasi masyarakat.',
                'kontak' => '0812-3456-7890',
            ],
            [
                'nama_lembaga' => 'Lembaga Pemberdayaan Masyarakat Desa (LPMD)',
                'deskripsi' => 'Lembaga yang membantu pemerintah desa dalam pemberdayaan masyarakat, pengembangan ekonomi, dan peningkatan kesejahteraan sosial.',
                'kontak' => '0813-9988-7766',
            ],
            [
                'nama_lembaga' => 'Pemberdayaan Kesejahteraan Keluarga (PKK)',
                'deskripsi' => 'Gerakan pembangunan masyarakat yang menggerakkan dan memberdayakan perempuan untuk berpartisipasi dalam pembangunan desa.',
                'kontak' => '0821-1122-3344',
            ],
            [
                'nama_lembaga' => 'Karang Taruna',
                'deskripsi' => 'Organisasi kepemudaan di tingkat desa yang bertujuan mengembangkan potensi pemuda dalam berbagai bidang kegiatan sosial, ekonomi, dan budaya.',
                'kontak' => '0855-6677-8899',
            ],
            [
                'nama_lembaga' => 'RT dan RW',
                'deskripsi' => 'Lembaga masyarakat yang merupakan bagian dari pemerintahan desa untuk melayani masyarakat di tingkat RT dan RW.',
                'kontak' => '0877-8899-0011',
            ],

            // Lembaga Ekonomi
            [
                'nama_lembaga' => 'Kelompok Tani Sumber Makmur',
                'deskripsi' => 'Kelompok tani yang mengembangkan usaha pertanian organik dan tanaman pangan untuk meningkatkan pendapatan petani.',
                'kontak' => '0899-0011-2233',
            ],
            [
                'nama_lembaga' => 'Kelompok Nelayan Mina Sejahtera',
                'deskripsi' => 'Kelompok nelayan yang mengembangkan budidaya ikan dan penangkapan ikan berkelanjutan di wilayah perairan desa.',
                'kontak' => null, // Tanpa kontak
            ],
            [
                'nama_lembaga' => 'Koperasi Desa Mandiri',
                'deskripsi' => 'Koperasi yang memberikan layanan simpan pinjam dan pengembangan usaha mikro untuk masyarakat desa.',
                'kontak' => '0811-2233-4455',
            ],
            [
                'nama_lembaga' => 'Kelompok Usaha Perempuan',
                'deskripsi' => 'Kelompok usaha yang digerakkan oleh ibu-ibu desa untuk memproduksi kerajinan tangan dan makanan olahan.',
                'kontak' => '0822-3344-5566',
            ],

            // Lembaga Sosial dan Keagamaan
            [
                'nama_lembaga' => 'Majelis Taklim Al-Ikhlas',
                'deskripsi' => 'Kelompok pengajian yang mengadakan kegiatan keagamaan dan pendidikan Islam untuk masyarakat.',
                'kontak' => '0833-4455-6677',
            ],
            [
                'nama_lembaga' => 'Posyandu Melati',
                'deskripsi' => 'Pos pelayanan terpadu yang memberikan layanan kesehatan ibu dan anak serta imunisasi.',
                'kontak' => '0844-5566-7788',
            ],
            [
                'nama_lembaga' => 'Tim Siaga Bencana',
                'deskripsi' => 'Kelompok masyarakat yang siap siaga dalam penanganan bencana alam dan keadaan darurat.',
                'kontak' => '0856-7788-9900',
            ],
            [
                'nama_lembaga' => 'Sanggar Seni Budaya',
                'deskripsi' => 'Kelompok yang melestarikan dan mengembangkan seni budaya tradisional desa seperti tari, musik, dan teater.',
                'kontak' => null, // Tanpa kontak
            ],

            // Lembaga Pendidikan
            [
                'nama_lembaga' => 'PAUD Bunga Desa',
                'deskripsi' => 'Pendidikan Anak Usia Dini yang memberikan layanan pendidikan untuk anak-anak pra-sekolah.',
                'kontak' => '0867-8899-0011',
            ],
            [
                'nama_lembaga' => 'Kelompok Belajar Masyarakat',
                'deskripsi' => 'Program pendidikan non-formal untuk masyarakat yang buta huruf atau putus sekolah.',
                'kontak' => '0878-9900-1122',
            ],

            // Lembaga Pemuda dan Olahraga
            [
                'nama_lembaga' => 'Klub Sepak Bola Desa',
                'deskripsi' => 'Klub olahraga yang mengembangkan bakat pemuda dalam bidang sepak bola dan mengikuti kompetisi.',
                'kontak' => '0889-0011-2233',
            ],
            [
                'nama_lembaga' => 'Pramuka Desa',
                'deskripsi' => 'Gerakan pramuka yang membina karakter dan keterampilan generasi muda desa.',
                'kontak' => null, // Tanpa kontak
            ],
        ];

        // Insert data ke database
        foreach ($lembagaData as $data) {
            LembagaDesa::create($data);
        }

        $this->command->info('Seeder Lembaga Desa berhasil dijalankan!');
        $this->command->info('Total data: ' . count($lembagaData));
        $this->command->info('Dengan kontak: ' . count(array_filter($lembagaData, function($item) {
            return !empty($item['kontak']);
        })));
        $this->command->info('Tanpa kontak: ' . count(array_filter($lembagaData, function($item) {
            return empty($item['kontak']);
        })));
    }
}
