<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Dosen;

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

class DosenController extends Controller
{

    public function index()
    {
        $post = Dosen::leftJoin('fakultas', 'dosen.id_fakultas', '=', 'fakultas.id')
            ->leftJoin('prodi', 'dosen.id_prodi', '=', 'prodi.id')
            ->select(
                'dosen.id',
                'dosen.nidn',
                'dosen.nama_dosen',
                'dosen.no_hp',
                'dosen.jabatan',
                'fakultas.nama_fakultas',
                'prodi.nama_jurusan'
            )
            ->groupBy(
                'dosen.id',
                'dosen.nidn',
                'dosen.nama_dosen',
                'dosen.no_hp',
                'dosen.jabatan',
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
            'id_fakultas'  => 'required',
            'id_prodi'  => 'required',
            'nidn'  => 'required',
            'nama_dosen'  => 'required',
            'no_hp'  => 'required',
            'jabatan'  => 'required',
            'email'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Rab
        $rab = Dosen::create([
            'id_fakultas' => $request->id_fakultas,
            'id_prodi' => $request->id_prodi,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $rab);
    }

    public function show($id)
    {
        //find post by ID
        $rab = Dosen::find($id);

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
            'id_fakultas'  => 'required',
            'id_prodi'  => 'required',
            'nidn'  => 'required',
            'nama_dosen'  => 'required',
            'no_hp'  => 'required',
            'jabatan'  => 'required',
            'email'  => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Find post by ID
        $rab = Dosen::find($id);

        $rab->update([
            'id_fakultas' => $request->id_fakultas,
            'id_prodi' => $request->id_prodi,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
        ]);

        // Return response
        return new PostResource(true, 'Data Berhasil Diubah!', $rab);
    }

    public function destroy($id)
    {

        //find post by ID
        $berita = Dosen::find($id);

        //delete post
        $berita->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
