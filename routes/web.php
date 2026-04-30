<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BukuTamuController;
use App\Http\Controllers\Admin\SurveiController;
use App\Http\Controllers\Admin\SettingController;

// Route Halaman Depan (Tamu)
Route::get('/', [GuestController::class, 'create'])->name('guest.form');
Route::post('/guest/store', [GuestController::class, 'store'])->name('guest.store');
Route::get('/indeks-kepuasan', [GuestController::class, 'indeks'])->name('guest.indeks');
Route::post('/indeks-kepuasan/store', [GuestController::class, 'storeIndeks'])->name('guest.storeIndeks');

// Route Auth Bawaan Laravel
Auth::routes();

// ==========================================
// ROUTE ADMIN DASHBOARD (WAJIB LOGIN)
// ==========================================
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    
    // 1. Dashboard Beranda
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Kelola Buku Tamu
    Route::resource('bukutamu', BukuTamuController::class);
    Route::get('/export/pdf', [BukuTamuController::class, 'exportPdf'])->name('bukutamu.pdf');
    Route::get('/export/excel', [BukuTamuController::class, 'exportExcel'])->name('bukutamu.excel');

    // 3. Kelola Survei Kepuasan
    Route::get('/survei', [SurveiController::class, 'index'])->name('survei.index');

    // 4. Pengaturan Akun
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');
});

// Redirect jika langsung akses /home
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
});