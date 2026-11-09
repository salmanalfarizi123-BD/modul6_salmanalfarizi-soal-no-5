<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('petugas')) {
            return redirect()->route('petugas.dashboard');
        } elseif ($user->hasRole('siswa')) {
            return redirect()->route('siswa.dashboard');
        } 
        return redirect()->route('buku.index'); 
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === TAMBAHAN SOAL 1 (A2, A3, & A4) ===
    Route::get('/buku-cari', [BukuController::class, 'cariSqlInjection']);
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show']); // A4
    

    // 1. Grup Admin & Petugas
    Route::middleware(['role:admin|petugas'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [BukuController::class, 'adminDashboard'])->name('dashboard');

        // Manajemen Pengguna (Khusus Admin)
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // Pengembalian & Laporan
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });


    // === TAMBAHAN KODE BARU (SOAL 3 / KELOLA BUKU) ===
    // Diperbaiki dengan menambahkan ->name('admin.') agar route resource memiliki prefiks admin.
    Route::middleware(['auth', 'can:kelola-buku'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('buku', BukuController::class);
    });

    // Sisa rute pengelolaan buku (index/status peminjaman) yang terikat nama admin
    Route::middleware(['can:kelola-buku'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::patch('/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    });

    // 2. Grup Khusus Dashboard Petugas
    Route::middleware(['role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/dashboard', [BukuController::class, 'petugasDashboard'])->name('dashboard');
    });

    // 3. Grup Khusus Dashboard & Peminjaman Siswa
    Route::middleware(['role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');

        Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/riwayat', [PeminjamanController::class, 'riwayatSiswa'])->name('riwayat');
    });

    // 4. AKSES BUKU UMUM
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');

});
Route::get('/test-error', function () {
    throw new \Exception('Simulasi error keamanan sistem!');
});

require __DIR__.'/auth.php';