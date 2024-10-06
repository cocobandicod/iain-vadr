<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\VerifikasiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;

//OPERATOR
use App\Http\Controllers\Api\PesanLainnyaOperatorController;

// Register
Route::post('/register', [VerifikasiController::class, 'daftar']);
Route::get('/cek/{username}/{nohp}', [VerifikasiController::class, 'cek']);
Route::get('/cekuser/{username}', [VerifikasiController::class, 'cekuser']);

Route::get('/membergroup/{id}/{kat}', [PesanLainnyaOperatorController::class, 'member_group']);
Route::get('/detailmember/{kat}', [PesanLainnyaOperatorController::class, 'detail_member']);
Route::post('/buatgroup', [PesanLainnyaOperatorController::class, 'buat_group']);
Route::post('/tambahmember', [PesanLainnyaOperatorController::class, 'tambah_member']);

//Route::post('/buatgroup', [PesanLainnyaOperatorController::class, 'buat_group']);
//Route::post('/send/pesan/lainnya', [PesanLainnyaOperatorController::class, 'kirim_pesan_lainnya']);
//Route::post('/send/gorup/lainnya', [PesanLainnyaOperatorController::class, 'kirim_group_lainnya']);

// Membatasi api akses dari luar aplikasi
Route::middleware('api.access')->group(function () {
    // Home Page
    Route::apiResource('/link', LinkController::class)->only(['index']);
    // Login
    Route::post('/login', [LoginController::class, 'login']);
    // Logout
    Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
});
