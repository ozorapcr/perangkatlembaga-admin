<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPerangkat = Perangkat::count();

        return view('dashboard', [
            'page' => 'dashboard',
            'jumlahPerangkat' => $jumlahPerangkat,
        ]);
    }
}
