<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelanganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::resource('meja', MejaController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/tes-admin', fn() => 'Halo admin!')->middleware('role:admin');
    Route::get('/tes-waiter-kasir', fn() => 'Halo waiter atau kasir!')->middleware('role:waiter,kasir');
});

Route::middleware('role:admin,waiter')->group(function () {
    Route::resource('menu', MenuController::class);
});

Route::middleware('role:waiter')->group(function () {
    Route::resource('pesanan', PesananController::class)->only(['index', 'create', 'store']);
    Route::post('/pelanggan', [PelanganController::class, 'store'])->name('pelanggan.store');
});

Route::middleware('role:kasir')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{pesanan}/bayar', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});

Route::middleware('role:waiter,kasir,owner')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});