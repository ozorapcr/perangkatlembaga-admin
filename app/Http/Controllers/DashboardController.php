<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard
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

        // Data statistik untuk dashboard
        $stats = [
            'total_rw' => 5,
            'total_warga' => 2065,
            'total_rt' => 24,
            'active_events' => 7
        ];

        // Recent activities
        $activities = [
            ['icon' => 'fas fa-user-plus', 'text' => 'Warga baru terdaftar di RW 01', 'time' => '2 jam lalu'],
            ['icon' => 'fas fa-file-alt', 'text' => 'Laporan keuangan bulanan dibuat', 'time' => '1 hari lalu'],
            ['icon' => 'fas fa-calendar', 'text' => 'Rapat rutin RW dijadwalkan', 'time' => '2 hari lalu'],
            ['icon' => 'fas fa-check-circle', 'text' => 'Proyek perbaikan jalan selesai', 'time' => '3 hari lalu']
        ];

        return view('dashboard.index', compact('stats', 'activities', 'user'));
    }
}