<?php

use App\Http\Controllers\RwController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route untuk Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk Dashboard dan RW (tanpa middleware)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/rw', [RwController::class, 'index'])->name('rw.index');

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});