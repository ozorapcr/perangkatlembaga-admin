<?php
namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use App\Models\Lembaga;
use App\Models\Perangkat;
use App\Models\JabatanLembaga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data dari database
        $jumlahPerangkat      = Perangkat::count();
        $jumlahWarga          = Warga::count();
        $jumlahLembaga        = Lembaga::count();
        $jumlahJabatanLembaga = JabatanLembaga::count();
        $jumlahRt            = Rt::count();
        $jumlahRw             = Rw::count();

        // Kirim data ke view dashboard
        return view('dashboard', compact(
            'jumlahPerangkat',
            'jumlahWarga',
            'jumlahLembaga',
            'jumlahJabatanLembaga',
            'jumlahRt',
            'jumlahRw'
        ));
        // CEK APAKAH USER SUDAH LOGIN
        if (! Session::get('user_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $jumlahPerangkat = Perangkat::count();

        return view('dashboard', [
            'page'            => 'dashboard',
            'jumlahPerangkat' => $jumlahPerangkat,
        ]);
    }
}
