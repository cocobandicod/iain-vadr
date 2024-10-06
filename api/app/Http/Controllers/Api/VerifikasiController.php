<?php

namespace App\Http\Controllers\Api;

//import Model "User"
use App\Models\User;
use App\Models\RegisMahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerifikasiController extends Controller
{
    public function cek($username, $nohp)
    {
        $cek = RegisMahasiswa::where('nim', $username)
            ->where('no_hp', $nohp)
            ->first(); // Menggunakan get() untuk mendapatkan koleksi data

        if (!$cek) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        return new PostResource(true, 'List Data', $cek);
    }

    public function cekuser($username)
    {
        $cek = User::where('username', $username)
            ->exists();

        if (!$cek) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404); // Mengembalikan status 404 jika user tidak ditemukan
        }

        return response()->json([
            'message' => 'User ditemukan',
            'data' => $username
        ], 200);
    }

    public function daftar(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'no_hp'    => 'required',
            'akses'    => 'required'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Inisiasi cURL
        $curl = curl_init();
        $token = env('WABLAS_API_TOKEN'); // Simpan token di .env

        // Data user
        $user = $request->username;
        $phone = $request->no_hp;
        $pass = strtoupper(Str::random(8));

        // Pesan yang akan dikirim via WhatsApp
        $message = urlencode("Akses VADR IAIN Gorontalo\nUsername: $user\nPassword: $pass\nAkses login: https://vadr.iaingorontalo.my.id/login\n\nJangan berikan akses ini ke orang lain.");

        // API Kirim ke nomor WhatsApp
        curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/send-message?phone=$phone&message=$message&token=$token");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Eksekusi cURL dan cek hasil
        $result = curl_exec($curl);

        // Cek apakah ada error saat eksekusi cURL
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            return response()->json(['message' => 'Gagal mengirim pesan WhatsApp: ' . $error_msg], 500);
        }

        curl_close($curl);

        // Simpan data user ke database
        $register = User::create([
            'username'   => $request->username,
            'password'   => Hash::make($pass),
            'hak_akses'  => $request->akses,
        ]);

        // Return response sukses
        return new PostResource(true, 'Data Berhasil Ditambahkan dan Pesan WhatsApp Dikirim!', $register);
    }
}
