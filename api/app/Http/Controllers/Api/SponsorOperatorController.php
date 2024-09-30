<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Sponsor;

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

class SponsorOperatorController extends Controller
{

    public function index()
    {

        //get all posts with user relationship loaded
        //$posts = Berita::with('user')->latest()->paginate(3);
        $sponsor = Sponsor::latest()->get();
        //return collection of posts as a resource
        //return response()->json($berita);
        return new PostResource(true, 'List Data', $sponsor);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'        => 'required',
            'image'        => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sponsor', $image->hashName());

        //create berita
        $sponsor = Sponsor::create([
            'judul'        => $request->judul,
            'image'        => $image->hashName(),
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $sponsor);
    }

    public function show($id)
    {
        //find post by ID
        $sponsor = Sponsor::find($id);

        if (!$sponsor) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $sponsor);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:1048', // Apply only if image exists
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find post by ID
        $sponsor = Sponsor::find($id);

        // Check if image is not empty
        if ($request->hasFile('image')) {

            // Upload image
            $image = $request->file('image');
            $image->storeAs('public/sponsor', $image->hashName());

            // Delete old image
            Storage::delete('public/sponsor/' . basename($sponsor->image));

            // Update post with new image
            $sponsor->update([
                'judul' => $request->judul,
                'image' => $image->hashName(),
            ]);
        } else {
            // Update post without image
            $sponsor->update([
                'judul' => $request->judul,
            ]);
        }

        // Return response
        return new PostResource(true, 'Data Berhasil Diubah!', $sponsor);
    }

    public function destroy($id)
    {

        //find post by ID
        $sponsor = Sponsor::find($id);

        //delete image
        Storage::delete('public/sponsor/' . basename($sponsor->image));

        //delete post
        $sponsor->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
