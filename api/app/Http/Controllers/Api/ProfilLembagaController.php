<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\ProfilLembaga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class ProfilLembagaController extends Controller
{

    public function show($id)
    {
        //find post by ID
        $ProfilLembaga = ProfilLembaga::find($id);

        //return single post as a resource
        return new PostResource(true, 'Sukses', $ProfilLembaga);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'no_sk' => 'required',
            'nama_lembaga' => 'required',
            'alamat_lembaga' => 'required',
            'no_telepon' => 'required',
            'no_fax' => 'required',
            'email' => 'required',
            'website' => 'required',
            'nama_jabatan' => 'required',
            'nidn_pimpinan' => 'required',
            'nama_pimpinan' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $ProfilLembaga = ProfilLembaga::find($id);

        //update
        $ProfilLembaga->update([
            'no_sk'             => $request->no_sk,
            'nama_lembaga'      => $request->nama_lembaga,
            'alamat_lembaga'    => $request->alamat_lembaga,
            'no_telepon'        => $request->no_telepon,
            'no_fax'            => $request->no_fax,
            'email'             => $request->email,
            'website'           => $request->website,
            'nama_jabatan'      => $request->nama_jabatan,
            'nidn_pimpinan'     => $request->nidn_pimpinan,
            'nama_pimpinan'     => $request->nama_pimpinan,
        ]);

        //return response
        return new PostResource(true, 'Sukses', $ProfilLembaga);
    }
}
