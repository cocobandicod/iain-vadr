<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\VerifikasiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;

//OPERATOR
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\LainnyaController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\FakultasController;

// Register
Route::post('/register', [VerifikasiController::class, 'daftar']);
Route::get('/cek/{username}/{nohp}', [VerifikasiController::class, 'cek']);
Route::get('/cekuser/{username}', [VerifikasiController::class, 'cekuser']);

Route::get('/group/{kat}', [GroupController::class, 'group']);
Route::get('/group/{kat}/{kode}', [GroupController::class, 'group_member']);

Route::get('/detailgroup/{kode}', [GroupController::class, 'detail_group']);
Route::post('/addgroup', [GroupController::class, 'add_group']);
Route::post('/updategroup/{kode}', [GroupController::class, 'update_group']);
Route::delete('/hapusgroup/{kode}', [GroupController::class, 'hapus_group']);

Route::get('/detailmember/{kat}/{id}', [GroupController::class, 'detail_member']);
Route::post('/addmember', [GroupController::class, 'add_member']);
Route::delete('/hapusmember/{id}', [GroupController::class, 'hapus_member']);

Route::post('/kirimbroadcast', [GroupController::class, 'kirim_broadcast']);
Route::post('/kirimpesan', [GroupController::class, 'kirim_pesan']);
Route::get('/reportpesan/{kat}', [GroupController::class, 'report_pesan']);

Route::apiResource('/mahasiswa', MahasiswaController::class);
Route::apiResource('/dosen', DosenController::class);
Route::apiResource('/pegawai', PegawaiController::class);
Route::apiResource('/lainnya', LainnyaController::class);

Route::get('/fakultas', [FakultasController::class, 'getFakultas']);
Route::get('/jurusan/{id}', [FakultasController::class, 'getJurusan']);

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
