<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Lainnya;

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

class LainnyaController extends Controller
{

    public function index()
    {
        $post = Lainnya::latest()->get();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data', $post);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_lainnya'  => 'required',
            'no_hp'         => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Rab
        $post = Lainnya::create([
            'nama_lainnya'  => $request->nama_lainnya,
            'no_hp'         => $request->no_hp,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }

    public function show($id)
    {
        //find post by ID
        $post = Lainnya::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data!', $post);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_lainnya'  => 'required',
            'no_hp'         => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Find post by ID
        $post = Lainnya::find($id);

        $post->update([
            'nama_lainnya'  => $request->nama_lainnya,
            'no_hp'         => $request->no_hp,
        ]);

        // Return response
        return new PostResource(true, 'Data Berhasil Diubah!', $post);
    }

    public function destroy($id)
    {

        //find post by ID
        $post = Lainnya::find($id);

        //delete post
        $post->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
