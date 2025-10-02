<?php
use App\Http\Controllers\Admin\PerangkatDesaController;

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::resource('perangkat', PerangkatDesaController::class);
});
