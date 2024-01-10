<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

//Login Routes
Route::get('/',[AuthController::class,'getLogin']);
Route::post('/',[AuthController::class,'postLogin'])->middleware('throttle:login');
Route::post('logout',[AuthController::class,'logout']);
//Admin Routes
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('dashboard', [Controller::class, 'getDashboard']);
    //Profil
    Route::get('profil/{id}', [AuthController::class, 'getProfil']);
    Route::put('profil/{id}', [AuthController::class, 'putPengguna']);
    Route::put('profil/ubah-password/{id}', [AuthController::class, 'putPassword']);
    // Master Pengguna
    Route::get('master/pengguna', [AuthController::class, 'getPengguna']);
    Route::post('master/pengguna', [AuthController::class, 'postPengguna']);
    Route::get('master/pengguna/detail/{id}', [AuthController::class, 'findPengguna']);
    Route::put('master/pengguna/detail/{id}', [AuthController::class, 'putPengguna']);
    Route::delete('master/pengguna/hapus/{id}', [AuthController::class, 'deletePengguna']);
    // Master Pelanggan
    Route::get('master/pelanggan', [PelangganController::class, 'getPelanggan']);
    Route::post('master/pelanggan', [PelangganController::class, 'postPelanggan']);
    Route::get('master/pelanggan/detail/{id}', [PelangganController::class, 'findPelanggan']);
    Route::put('master/pelanggan/detail/{id}', [PelangganController::class, 'putPelanggan']);
    Route::delete('master/pelanggan/hapus/{id}', [PelangganController::class, 'deletePelanggan']);
    // Transaksi
    Route::get('transaksi', [TransaksiController::class, 'getTransaksi']);
});
