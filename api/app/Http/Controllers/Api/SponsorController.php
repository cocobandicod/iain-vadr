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

class SponsorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $posts = Sponsor::latest()->get();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Posts', ['data' => $posts]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'   => 'required',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sponsor', $image->hashName());

        //create sponsor
        $post = Sponsor::create([
            'judul'     => $request->judul,
            'image'     => $image->hashName(),
        ]);

        //return response
        return new PostResource(true, 'Data Sponsor Berhasil Ditambahkan!', $post);
    }

    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */

    public function show($id)
    {
        //find post by ID
        $post = Sponsor::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $post);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Sponsor::find($id);

        if (!$post) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/sponsor', $image->hashName());

            //delete old image
            Storage::delete('public/sponsor/' . basename($post->image));

            //update post with new image
            $post->update([
                'judul' => $request->judul,
                'image' => $image->hashName(),
            ]);
        } else {
            //update post without image
            $post->update([
                'judul' => $request->judul,
            ]);
        }

        //return response
        return new PostResource(true, 'Data Sponsor Berhasil Diubah!', $post);
    }

    public function destroy($id)
    {

        //find post by ID
        $post = Sponsor::find($id);

        //delete image
        Storage::delete('public/sponsor/' . basename($post->image));

        //delete post
        $post->delete();

        //return response
        return new PostResource(true, 'Data Sponsor Berhasil Dihapus!', null);
    }
}
