<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

//import Facade "Str"
use Illuminate\Support\Str;

class PegawaiController extends Controller
{

    public function index()
    {
        $post = Pegawai::leftJoin('fakultas', 'pegawai.id_fakultas', '=', 'fakultas.id')
            ->leftJoin('prodi', 'pegawai.id_prodi', '=', 'prodi.id')
            ->select(
                'pegawai.id',
                'pegawai.nip',
                'pegawai.nama_pegawai',
                'pegawai.no_hp',
                'fakultas.nama_fakultas',
                'prodi.nama_jurusan'
            )
            ->groupBy(
                'pegawai.id',
                'pegawai.nip',
                'pegawai.nama_pegawai',
                'pegawai.no_hp',
                'fakultas.nama_fakultas',
                'prodi.nama_jurusan'
            )
            ->get();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data', $post);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kelompok_rab'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Rab
        $rab = Pegawai::create([
            'kelompok_rab' => $request->kelompok_rab,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $rab);
    }

    public function show($id)
    {
        //find post by ID
        $rab = Pegawai::find($id);

        if (!$rab) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data!', $rab);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'kelompok_rab' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Find post by ID
        $rab = Pegawai::find($id);

        $rab->update([
            'kelompok_rab' => $request->kelompok_rab,
        ]);

        // Return response
        return new PostResource(true, 'Data Berhasil Diubah!', $rab);
    }

    public function destroy($id)
    {

        //find post by ID
        $berita = Pegawai::find($id);

        //delete post
        $berita->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
