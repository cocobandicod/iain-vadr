<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\SponsorController;
use App\Http\Controllers\Api\LowonganPenelitianController;
use App\Http\Controllers\Api\LowonganPengabdianController;
use App\Http\Controllers\Api\PanduanController;
use App\Http\Controllers\Api\ProfilPengusulController;
use App\Http\Controllers\Api\ProfilLembagaController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\SintaController;

use App\Http\Controllers\Api\BeritaOperatorController;
use App\Http\Controllers\Api\KelompokRabOperatorController;
use App\Http\Controllers\Api\PengumumanOperatorController;
use App\Http\Controllers\Api\PanduanOperatorController;
use App\Http\Controllers\Api\SponsorOperatorController;
use App\Http\Controllers\Api\TautanOperatorController;


Route::get('/formidentitas/{id}', [ProfilPengusulController::class, 'formidentitas']);



// Membatasi api akses dari luar aplikasi
Route::middleware('api.access')->group(function () {
    // Home Page
    Route::apiResource('/berita', BeritaController::class)->only(['index', 'show']);
    Route::apiResource('/sponsor', SponsorController::class)->only(['index']);
    Route::apiResource('/pengumuman', PengumumanController::class);
    Route::apiResource('/lowonganpenelitian', LowonganPenelitianController::class);
    Route::apiResource('/lowonganpengabdian', LowonganPengabdianController::class);
    Route::apiResource('/panduan', PanduanController::class);
    Route::apiResource('/link', LinkController::class)->only(['index']);

    // Register
    Route::apiResource('/register', RegisterController::class)->only(['store']);

    // Login
    Route::post('/login', [LoginController::class, 'login']);
    // Logout
    Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');

    // Pengusul
    Route::apiResource('/profilpengusul', ProfilPengusulController::class);
    Route::apiResource('/sinta', SintaController::class);

    // Lembaga Operator
    Route::apiResource('/formlembaga', ProfilLembagaController::class);
    // Berita Operator
    Route::apiResource('/beritaform', BeritaOperatorController::class);
    // Kelompok Rab Operator
    Route::apiResource('/kelompokrabform', KelompokRabOperatorController::class);
    // Pengumuman Operator
    Route::apiResource('/pengumumanform', PengumumanOperatorController::class);
    // Panduan Operator
    Route::apiResource('/panduanform', PanduanOperatorController::class);
    // Tautan Operator
    Route::apiResource('/tautanform', TautanOperatorController::class);
    // Sponsor Operator
    Route::apiResource('/sponsorform', SponsorOperatorController::class);
});
