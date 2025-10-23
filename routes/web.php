<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerangkatController;

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