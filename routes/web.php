<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Http\Controllers\JabatanLembagaController;

// Halaman login & register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (hanya bisa diakses jika sudah login)
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['checkislogin'])->group(function () {

    // Dashboard bisa diakses semua user yang login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =============================
    // ADMIN (FULL AKSES)
    // =============================
    Route::middleware(['checkrole:Admin'])->group(function () {

        // Perangkat
        Route::resource('perangkat', PerangkatController::class);

        // RW
        Route::resource('rw', RwController::class);

        // RT
        Route::resource('rt', RtController::class);

        // Lembaga Desa
        Route::resource('lembaga', LembagaController::class);

        // Jabatan Lembaga
        Route::resource('jabatan', JabatanLembagaController::class);

        // Anggota Lembaga
        Route::resource('anggota-lembaga', AnggotaLembagaController::class);

        // Warga
        Route::resource('warga', WargaController::class);

        // Profile
        Route::resource('profile', ProfileController::class);

        // Lembaga Desa tambahan
        Route::resource('lembaga_desa', LembagaDesaController::class);
    });

    // =============================
    // PEGAWAI (Hanya Lihat + Tambah)
    // =============================
    Route::middleware(['checkrole:Pegawai'])->group(function () {

        // Perangkat
        Route::resource('perangkat', PerangkatController::class)->only(['index','show','create','store']);

        // RW
        Route::resource('rw', RwController::class)->only(['index','show','create','store']);

        // RT
        Route::resource('rt', RtController::class)->only(['index','show','create','store']);

        // Lembaga Desa
        Route::resource('lembaga', LembagaController::class)->only(['index','show','create','store']);

        // Jabatan Lembaga
        Route::resource('jabatan', JabatanLembagaController::class)->only(['index','show','create','store']);

        // Anggota Lembaga
        Route::resource('anggota-lembaga', AnggotaLembagaController::class)->only(['index','show','create','store']);

        // Warga
        Route::resource('warga', WargaController::class)->only(['index','show','create','store']);

        // Profile
        Route::resource('profile', ProfileController::class)->only(['index','show','create','store']);

        // Lembaga Desa tambahan
        Route::resource('lembaga_desa', LembagaDesaController::class)->only(['index','show','create','store']);
    });
});
