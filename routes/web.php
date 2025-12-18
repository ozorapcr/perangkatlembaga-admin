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
Route::get('/rw/{rw}/edit', [RwController::class, 'edit'])->name('rw.edit');
Route::put('/rw/{rw}', [RwController::class, 'update'])->name('rw.update');
Route::delete('/rw/{rw}', [RwController::class, 'destroy'])->name('rw.destroy');
Route::get('/rw/{rw}', [RwController::class, 'show'])->name('rw.show');

// ===========================================
// ROUTES CRUD RT (Konsisten dengan pola RW)
// ===========================================

// Tampilkan daftar RT
Route::get('/rt', [RtController::class, 'index'])->name('rt.index');

// Tampilkan form tambah RT
Route::get('/rt/create', [RtController::class, 'create'])->name('rt.create');

// Simpan data RT baru ke database
Route::post('/rt', [RtController::class, 'store'])->name('rt.store');

// Tampilkan detail RT tertentu
Route::get('/rt/{rt}', [RtController::class, 'show'])->name('rt.show');

// Tampilkan form edit RT tertentu
Route::get('/rt/{rt}/edit', [RtController::class, 'edit'])->name('rt.edit');

// Update data RT di database
Route::put('/rt/{rt}', [RtController::class, 'update'])->name('rt.update');

// Hapus data RT
Route::delete('/rt/{rt}', [RtController::class, 'destroy'])->name('rt.destroy');

// ===========================================
// ROUTES CRUD LEMBAGA DESA (Konsisten dengan pola RW & RT)
// ===========================================

// Tampilkan daftar Lembaga Desa
Route::get('/lembaga', [LembagaController::class, 'index'])->name('lembaga.index');

// Tampilkan form tambah Lembaga Desa
Route::get('/lembaga/create', [LembagaController::class, 'create'])->name('lembaga.create');

// Simpan data Lembaga Desa baru ke database
Route::post('/lembaga', [LembagaController::class, 'store'])->name('lembaga.store');

// Tampilkan detail Lembaga Desa tertentu
Route::get('/lembaga/{lembaga}', [LembagaController::class, 'show'])->name('lembaga.show');

// Tampilkan form edit Lembaga Desa tertentu
Route::get('/lembaga/{lembaga}/edit', [LembagaController::class, 'edit'])->name('lembaga.edit');

// Update data Lembaga Desa di database
Route::put('/lembaga/{lembaga}', [LembagaController::class, 'update'])->name('lembaga.update');

// Hapus data Lembaga Desa
Route::delete('/lembaga/{lembaga}', [LembagaController::class, 'destroy'])->name('lembaga.destroy');



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