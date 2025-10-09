<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek jika user sudah login
        if (!session('user_logged_in')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Data user dari session
        $user = [
            'username' => session('user_username'),
            'email' => session('user_email'),
            'role' => session('user_role')
        ];

        $rw = [
            [
                'rw_id' => 1,
                'nomor_rw' => 'RW 01',
                'ketua_rw' => 'Budi Santoso',
                'ketua_rw_warga_id' => 'W001',
                'jumlah_rt' => 4,
                'jumlah_warga' => 450,
                'keterangan' => 'Wilayah RW 01 - Timur'
            ],
            [
                'rw_id' => 2,
                'nomor_rw' => 'RW 02',
                'ketua_rw' => 'Siti Rahayu',
                'ketua_rw_warga_id' => 'W002',
                'jumlah_rt' => 3,
                'jumlah_warga' => 320,
                'keterangan' => 'Wilayah RW 02 - Barat'
            ],
            [
                'rw_id' => 3,
                'nomor_rw' => 'RW 03',
                'ketua_rw' => 'Ahmad Fauzi',
                'ketua_rw_warga_id' => 'W003',
                'jumlah_rt' => 5,
                'jumlah_warga' => 580,
                'keterangan' => 'Wilayah RW 03 - Selatan'
            ],
            [
                'rw_id' => 4,
                'nomor_rw' => 'RW 04',
                'ketua_rw' => 'Maya Sari',
                'ketua_rw_warga_id' => 'W004',
                'jumlah_rt' => 4,
                'jumlah_warga' => 410,
                'keterangan' => 'Wilayah RW 04 - Utara'
            ],
        ];

        return view('rw.index', compact('rw', 'user'));
    }
}