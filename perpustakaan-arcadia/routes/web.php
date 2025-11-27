<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPeminjamController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\PeminjamanPeminjamController;
use App\Http\Controllers\PeminjamanAdminController;
use App\Http\Controllers\BukuController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Routes untuk Peminjam
Route::prefix('peminjam')->group(function () {
    // Auth
    Route::get('register', [AuthPeminjamController::class, 'showRegister'])->name('peminjam.register');
    Route::post('register', [AuthPeminjamController::class, 'register'])->name('peminjam.register.submit');
    Route::get('login', [AuthPeminjamController::class, 'showLogin'])->name('peminjam.login');
    Route::post('login', [AuthPeminjamController::class, 'login'])->name('peminjam.login.submit');
    Route::get('logout', [AuthPeminjamController::class, 'logout'])->name('peminjam.logout');
    
    // Dashboard & Peminjaman (harus login)
    Route::middleware(['peminjam'])->group(function () {
        Route::get('dashboard', [PeminjamanPeminjamController::class, 'dashboard'])->name('peminjam.dashboard');
        Route::get('create', [PeminjamanPeminjamController::class, 'create'])->name('peminjam.create');
        Route::post('store', [PeminjamanPeminjamController::class, 'store'])->name('peminjam.store');
        Route::get('show/{kode_pinjam}', [PeminjamanPeminjamController::class, 'show'])->name('peminjam.show');
        Route::delete('destroy/{kode_pinjam}', [PeminjamanPeminjamController::class, 'destroy'])->name('peminjam.destroy');
    });
});

// Routes untuk Admin
Route::prefix('admin')->group(function () {
    // Auth
    Route::get('login', [AuthAdminController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AuthAdminController::class, 'login'])->name('admin.login.submit');
    Route::get('logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    
    // Dashboard & Management (harus login)
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [PeminjamanAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('peminjaman/show/{kode_pinjam}', [PeminjamanAdminController::class, 'show'])->name('admin.peminjaman.show');
        Route::post('peminjaman/approve/{kode_pinjam}', [PeminjamanAdminController::class, 'approve'])->name('admin.peminjaman.approve');
        Route::post('peminjaman/reject/{kode_pinjam}', [PeminjamanAdminController::class, 'reject'])->name('admin.peminjaman.reject');
        Route::post('peminjaman/complete/{kode_pinjam}', [PeminjamanAdminController::class, 'complete'])->name('admin.peminjaman.complete');
        Route::delete('peminjaman/destroy/{kode_pinjam}', [PeminjamanAdminController::class, 'destroy'])->name('admin.peminjaman.destroy');
        
        // CRUD Buku
        Route::get('buku', [BukuController::class, 'index'])->name('admin.buku.index');
        Route::get('buku/create', [BukuController::class, 'create'])->name('admin.buku.create');
        Route::post('buku', [BukuController::class, 'store'])->name('admin.buku.store');
        Route::get('buku/{id}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
        Route::put('buku/{id}', [BukuController::class, 'update'])->name('admin.buku.update');
        Route::delete('buku/{id}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');
    });
});