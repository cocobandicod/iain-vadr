<?php

namespace App\Http\Controllers\Api;

//import Model "User"
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Cek kredensial
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Buat token API
            $token = $user->createToken('API Token')->plainTextToken;

            // Return sukses dengan token
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'token' => $token,
                'id_user' => $user->id,
                'nama_pengguna' => $user->name,
                'hak_akses' => $user->hak_akses,
            ]);
        }

        // Return gagal
        return response()->json(['message' => 'Username dan Password Salah']);
    }
}
