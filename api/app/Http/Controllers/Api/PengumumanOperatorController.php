<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Pengumuman;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PengumumanOperatorController extends Controller
{
    public function index()
    {

        //get all posts with user relationship loaded
        //$posts = Berita::with('user')->latest()->paginate(3);
        $berita = Pengumuman::with('user')->orderBy('tgl_pengumuman', 'desc')->get();

        //return collection of posts as a resource
        //return response()->json($berita);
        return new PostResource(true, 'List Data', $berita);
    }

    public function show($id)
    {
        //find post by ID
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data', $pengumuman);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_user'            => 'required',
            'judul_pengumuman'   => 'required',
            'tgl_pengumuman'     => 'required',
            'isi_pengumuman'     => 'required',
            'file_pengumuman'    => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('file_pengumuman')) {

            // Upload PDF file
            $file = $request->file('file_pengumuman');
            $file->storeAs('public/pengumuman', $file->hashName());

            // Update Pengumuman with new file
            $post = Pengumuman::create([
                'id_user'           => $request->id_user,
                'judul_pengumuman'  => $request->judul_pengumuman,
                'tgl_pengumuman'    => $request->tgl_pengumuman,
                'isi_pengumuman'    => $request->isi_pengumuman,
                'file_pengumuman'   => $file->hashName(),
            ]);
        } else {
            // Update Pengumuman without file
            $post = Pengumuman::create([
                'id_user'           => $request->id_user,
                'judul_pengumuman'  => $request->judul_pengumuman,
                'tgl_pengumuman'    => $request->tgl_pengumuman,
                'isi_pengumuman'    => $request->isi_pengumuman,
            ]);
        }

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul_pengumuman'   => 'required',
            'tgl_pengumuman'     => 'required',
            'isi_pengumuman'     => 'required',
            'file_pengumuman'    => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Pengumuman by ID
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Check if file_pengumuman is not empty
        if ($request->hasFile('file_pengumuman')) {

            // Upload PDF file
            $file = $request->file('file_pengumuman');
            $file->storeAs('public/pengumuman', $file->hashName());

            // Delete old file
            Storage::delete('public/pengumuman/' . basename($pengumuman->file_pengumuman));

            // Update Pengumuman with new file
            $pengumuman->update([
                'judul_pengumuman'  => $request->judul_pengumuman,
                'tgl_pengumuman'    => $request->tgl_pengumuman,
                'isi_pengumuman'    => $request->isi_pengumuman,
                'file_pengumuman'   => $file->hashName(),
            ]);
        } else {
            // Update Pengumuman without file
            $pengumuman->update([
                'judul_pengumuman'  => $request->judul_pengumuman,
                'tgl_pengumuman'    => $request->tgl_pengumuman,
                'isi_pengumuman'    => $request->isi_pengumuman,
            ]);
        }

        //return response
        return new PostResource(true, 'Data Berhasil Diubah!', $pengumuman);
    }

    public function destroy($id)
    {

        // Find Pengumuman by ID
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Delete PDF file
        Storage::delete('public/pengumuman/' . basename($pengumuman->file_pengumuman));

        // Delete Pengumuman
        $pengumuman->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
