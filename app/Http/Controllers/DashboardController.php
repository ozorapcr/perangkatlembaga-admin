<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // CEK APAKAH USER SUDAH LOGIN
        if (!Session::get('user_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $jumlahPerangkat = Perangkat::count();

        return view('dashboard', [
            'page' => 'dashboard',
            'jumlahPerangkat' => $jumlahPerangkat,
        ]);
    }
}