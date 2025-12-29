<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\JabatanLembagaController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Http\Controllers\DeveloperController; // <-- TAMBAHKAN INI

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

// ===========================================
// ROUTES CRUD PERANGKAT
// ===========================================
Route::get('/perangkat', [PerangkatController::class, 'index'])->name('perangkat.index');
Route::get('/perangkat/create', [PerangkatController::class, 'create'])->name('perangkat.create');
Route::post('/perangkat', [PerangkatController::class, 'store'])->name('perangkat.store');
Route::get('/perangkat/{perangkat}/edit', [PerangkatController::class, 'edit'])->name('perangkat.edit');
Route::put('/perangkat/{perangkat}', [PerangkatController::class, 'update'])->name('perangkat.update');
Route::delete('/perangkat/{perangkat}', [PerangkatController::class, 'destroy'])->name('perangkat.destroy');

// ===========================================
// ROUTES CRUD RW
// ===========================================
Route::get('/rw', [RwController::class, 'index'])->name('rw.index');
Route::get('/rw/create', [RwController::class, 'create'])->name('rw.create');
Route::post('/rw', [RwController::class, 'store'])->name('rw.store');
Route::get('/rw/{rw}/edit', [RwController::class, 'edit'])->name('rw.edit');
Route::put('/rw/{rw}', [RwController::class, 'update'])->name('rw.update');
Route::delete('/rw/{rw}', [RwController::class, 'destroy'])->name('rw.destroy');
Route::get('/rw/{rw}', [RwController::class, 'show'])->name('rw.show');

// ===========================================
// ROUTES CRUD RT
// ===========================================
Route::get('/rt', [RtController::class, 'index'])->name('rt.index');
Route::get('/rt/create', [RtController::class, 'create'])->name('rt.create');
Route::post('/rt', [RtController::class, 'store'])->name('rt.store');
Route::get('/rt/{rt}', [RtController::class, 'show'])->name('rt.show');
Route::get('/rt/{rt}/edit', [RtController::class, 'edit'])->name('rt.edit');
Route::put('/rt/{rt}', [RtController::class, 'update'])->name('rt.update');
Route::delete('/rt/{rt}', [RtController::class, 'destroy'])->name('rt.destroy');

// ===========================================
// ROUTES CRUD LEMBAGA DESA
// ===========================================
Route::get('/lembaga', [LembagaController::class, 'index'])->name('lembaga.index');
Route::get('/lembaga/create', [LembagaController::class, 'create'])->name('lembaga.create');
Route::post('/lembaga', [LembagaController::class, 'store'])->name('lembaga.store');
Route::get('/lembaga/{lembaga}', [LembagaController::class, 'show'])->name('lembaga.show');
Route::get('/lembaga/{lembaga}/edit', [LembagaController::class, 'edit'])->name('lembaga.edit');
Route::put('/lembaga/{lembaga}', [LembagaController::class, 'update'])->name('lembaga.update');
Route::delete('/lembaga/{lembaga}', [LembagaController::class, 'destroy'])->name('lembaga.destroy');

// ===========================================
// ROUTES CRUD JABATAN LEMBAGA (Konsisten dengan pola Lembaga)
// ===========================================

// Tampilkan daftar Jabatan Lembaga
Route::get('/jabatan', [JabatanLembagaController::class, 'index'])->name('jabatan.index');

// Tampilkan form tambah Jabatan Lembaga
Route::get('/jabatan/create', [JabatanLembagaController::class, 'create'])->name('jabatan.create');

// Simpan data Jabatan Lembaga baru ke database
Route::post('/jabatan', [JabatanLembagaController::class, 'store'])->name('jabatan.store');

// Tampilkan detail Jabatan Lembaga tertentu
Route::get('/jabatan/{jabatan_lembaga}', [JabatanLembagaController::class, 'show'])->name('jabatan.show');

// Tampilkan form edit Jabatan Lembaga tertentu
Route::get('/jabatan/{jabatan_lembaga}/edit', [JabatanLembagaController::class, 'edit'])->name('jabatan.edit');

// Update data Jabatan Lembaga di database
Route::put('/jabatan/{jabatan_lembaga}', [JabatanLembagaController::class, 'update'])->name('jabatan.update');

// Hapus data Jabatan Lembaga
Route::delete('/jabatan/{jabatan_lembaga}', [JabatanLembagaController::class, 'destroy'])->name('jabatan.destroy');

// ===========================================
// ROUTES CRUD ANGGOTA LEMBAGA
// ===========================================
Route::get('/anggota-lembaga', [AnggotaLembagaController::class, 'index'])->name('anggota-lembaga.index');
Route::get('/anggota-lembaga/create', [AnggotaLembagaController::class, 'create'])->name('anggota-lembaga.create');
Route::post('/anggota-lembaga', [AnggotaLembagaController::class, 'store'])->name('anggota-lembaga.store');
Route::get('/anggota-lembaga/{anggota_lembaga}', [AnggotaLembagaController::class, 'show'])->name('anggota-lembaga.show');
Route::get('/anggota-lembaga/{anggota_lembaga}/edit', [AnggotaLembagaController::class, 'edit'])->name('anggota-lembaga.edit');
Route::put('/anggota-lembaga/{anggota_lembaga}', [AnggotaLembagaController::class, 'update'])->name('anggota-lembaga.update');
Route::delete('/anggota-lembaga/{anggota_lembaga}', [AnggotaLembagaController::class, 'destroy'])->name('anggota-lembaga.destroy');

// ===========================================
// ROUTES CRUD WARGA (Versi Manual Lengkap)
// ===========================================

// Tampilkan daftar warga
Route::get('/warga', [WargaController::class, 'index'])->