<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Berita;

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

class BeritaOperatorController extends Controller
{

    public function index()
    {

        //get all posts with user relationship loaded
        //$posts = Berita::with('user')->latest()->paginate(3);
        $berita = Berita::with('user')->orderBy('tgl_berita', 'desc')->get();

        //return collection of posts as a resource
        //return response()->json($berita);
        return new PostResource(true, 'List Data Berita', $berita);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_user'        => 'required',
            'judul_berita'   => 'required',
            'judul_seo'      => Str::slug($request->judul_berita),
            'tgl_berita'     => 'required',
            'isi_berita'     => 'required',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/berita', $image->hashName());

        //create berita
        $berita = Berita::create([
            'id_user'      => $request->id_user,
            'judul_berita' => $request->judul_berita,
            'judul_seo'    => Str::slug($request->judul_berita),
            'tgl_berita'   => $request->tgl_berita,
            'jam_berita'   => date('H:i:s'),
            'isi_berita'   => $request->isi_berita,
            'image'        => $image->hashName(),
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $berita);
    }

    public function show($id)
    {
        //find post by ID
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $berita);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'judul_berita' => 'required',
            'tgl_berita'   => 'required',
            'isi_berita'   => 'required',
            'image'        => 'nullable|mimes:jpg,jpeg,png|max:2048', // Apply only if image exists
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find post by ID
        $berita = Berita::find($id);

        // Check if image is not empty
        if ($request->hasFile('image')) {

            // Upload image
            $image = $request->file('image');
            $image->storeAs('public/berita', $image->hashName());

            // Delete old image
            Storage::delete('public/berita/' . basename($berita->image));

            // Update post with new image
            $berita->update([
                'judul_berita' => $request->judul_berita,
                'judul_seo'    => Str::slug($request->judul_berita),
                'tgl_berita'   => $request->tgl_berita,
                'jam_berita'   => date('H:i:s'),
                'isi_berita'   => $request->isi_berita,
                'image'        => $image->hashName(),
            ]);
        } else {
            // Update post without image
            $berita->update([
                'judul_berita' => $request->judul_berita,
                'judul_seo'    => Str::slug($request->judul_berita),
                'tgl_berita'   => $request->tgl_berita,
                'jam_berita'   => date('H:i:s'),
                'isi_berita'   => $request->isi_berita,
            ]);
        }

        // Return response
        return new PostResource(true, 'Data Berhasil Diubah!', $berita);
    }

    public function destroy($id)
    {

        //find post by ID
        $berita = Berita::find($id);

        //delete image
        Storage::delete('public/berita/' . basename($berita->image));

        //delete post
        $berita->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
