<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'loginForm'])->name('home');

// Route untuk Autentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Middleware untuk memeriksa peran pengguna
Route::middleware(['auth', 'checkRole:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', function () {
        return view('karyawan.dashboard');
    })->name('karyawan.dashboard');
    Route::post('/karyawan/presensi/masuk', [AbsensiController::class, 'presensiMasuk'])->name('karyawan.presensi.masuk');
    Route::post('/karyawan/presensi/pulang', [AbsensiController::class, 'presensiPulang'])->name('karyawan.presensi.pulang');
    Route::get('/karyawan/absensi/riwayat', [AbsensiController::class, 'riwayatAbsensiKaryawan'])->name('karyawan.absensi.riwayat');
});

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Kelola Data Karyawan
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/admin/karyawan/create', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::get('/admin/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::put('/admin/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::delete('/admin/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');

    // Rekap Absensi Semua Karyawan
    Route::get('/admin/absensi/rekap', [AbsensiController::class, 'rekapAbsensiAdmin'])->name('admin.absensi.rekap');

    // Hitung Gaji Bulanan
    Route::get('/admin/gaji/rekap', [AbsensiController::class, 'hitungGajiBulanan'])->name('admin.gaji.rekap');
});