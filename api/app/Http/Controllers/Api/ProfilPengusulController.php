<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\ProfilPengusul;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class ProfilPengusulController extends Controller
{
    public function show($id)
    {
        //find post by ID
        $profilpengusul = ProfilPengusul::with('user', 'institusi', 'sinta')
            ->where('id_user', $id)
            ->first();

        //return single post as a resource
        return new PostResource(true, 'Sukses', $profilpengusul);
    }

    public function formidentitas($id)
    {
        //find post by ID
        $profilpengusul = ProfilPengusul::with('user', 'institusi')
            ->where('id_user', $id)
            ->first();

        //return single post as a resource
        return new PostResource(true, 'Sukses', $profilpengusul);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_sinta' => 'required',
            'id_scholar' => 'required',
            'jenjang_pendidikan' => 'required',
            'jabatan_akademik' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ktp' => 'required',
            'no_telepon' => 'required',
            'no_hp' => 'required',
            'alamat_surel' => 'required',
            'website_personal' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $profilPengusul = ProfilPengusul::find($id);

        //update
        $profilPengusul->update([
            'id_sinta'              => $request->id_sinta,
            'id_scholar'            => $request->id_scholar,
            'jenjang_pendidikan'    => $request->jenjang_pendidikan,
            'jabatan_akademik'      => $request->jabatan_akademik,
            'alamat'                => $request->alamat,
            'tempat_lahir'          => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'no_ktp'                => $request->no_ktp,
            'no_telepon'            => $request->no_telepon,
            'no_hp'                 => $request->no_hp,
            'alamat_surel'          => $request->alamat_surel,
            'website_personal'      => $request->website_personal,
        ]);

        //return response
        return new PostResource(true, 'Sukses', $profilPengusul);
    }
}
