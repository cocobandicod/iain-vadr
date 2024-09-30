<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Link;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class TautanOperatorController extends Controller
{
    public function index()
    {

        //get all posts with user relationship loaded
        //$posts = Berita::with('user')->latest()->paginate(3);
        $tautan = Link::latest()->get();

        //return collection of posts as a resource
        //return response()->json($berita);
        return new PostResource(true, 'List Data', $tautan);
    }

    public function show($id)
    {
        //find post by ID
        $tautan = Link::find($id);

        if (!$tautan) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data', $tautan);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'link'      => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create
        $post = Link::create([
            'judul' => $request->judul,
            'link'  => $request->link,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'link'      => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find by ID
        $tautan = Link::find($id);

        if (!$tautan) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $tautan->update([
            'judul' => $request->judul,
            'link'  => $request->link,
        ]);


        //return response
        return new PostResource(true, 'Data Berhasil Diubah!', $tautan);
    }

    public function destroy($id)
    {

        // Find by ID
        $tautan = Link::find($id);

        if (!$tautan) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Delete
        $tautan->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
