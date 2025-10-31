<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RwController;

// Halaman login & register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Dashboard (hanya bisa diakses jika sudah login)


Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/perangkat', [PerangkatController::class, 'index'])->name('perangkat.index');
// Form tambah perangkat
Route::get('/perangkat/create', [PerangkatController::class, 'create'])->name('perangkat.create');
// Simpan perangkat baru
Route::post('/perangkat', [PerangkatController::class, 'store'])->name('perangkat.store');
// Form edit perangkat
Route::get('/perangkat/{perangkat}/edit', [PerangkatController::class, 'edit'])->name('perangkat.edit');
// Update perangkat
Route::put('/perangkat/{perangkat}', [PerangkatController::class, 'update'])->name('perangkat.update');
// Hapus perangkat
Route::delete('/perangkat/{perangkat}', [PerangkatController::class, 'destroy'])->name('perangkat.destroy');



Route::get('/rw', [RwController::class, 'index'])->name('rw.index');
Route::get('/rw/create', [RwController::class, 'create'])->name('rw.create');
Route::post('/rw', [RwController::class, 'store'])->name('rw.store');
Route::get('/rw/{id}/edit', [RwController::class, 'edit'])->name('rw.edit');
Route::put('/rw/{id}', [RwController::class, 'update'])->name('rw.update');
Route::delete('/rw/{id}', [RwController::class, 'destroy'])->name('rw.destroy');
Route::get('/rw/{id}', [RwController::class, 'show'])->name('rw.show');




// ===========================================
// ROUTES CRUD WARGA (Versi Manual Lengkap)
// ===========================================

// Tampilkan daftar warga
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');

// Tampilkan form tambah warga
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');

// Simpan data baru ke database
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');

// Tampilkan form edit warga tertentu
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');

// Update data warga di database
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');

// Hapus data warga
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

