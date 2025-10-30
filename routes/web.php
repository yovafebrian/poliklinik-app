<?php

use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\ObatController as ControllersObatController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\Pasien\PoliController as PasienPoliController;
use App\Http\Controllers\PoliController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
Route::post('/login',[AuthController::class, 'login']);

Route::get('/register',[AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('polis', PoliController::class);
    Route::resource('dokters', DokterController::class);
    Route::resource('pasiens',PasienController::class);
    Route::resource('obats', ControllersObatController::class);
});

Route::middleware(['auth','role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // lindungi resource jadwal-periksa agar hanya dokter yang mengakses
    Route::resource('jadwal-periksa', JadwalPeriksaController::class);
});

Route::middleware(['auth','role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
    Route::get('/daftar', [PasienPoliController::class, 'get'])->name('pasien.daftar');
    Route::post('/daftar', [PasienPoliController::class, 'submit'])->name('pasien.daftar');
});

