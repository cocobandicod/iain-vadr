<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Berita;

use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

class BeritaController extends Controller
{
    public function index()
    {

        //get all posts with user relationship loaded
        //$posts = Berita::with('user')->latest()->paginate(3);
        $berita = Berita::with('user')->orderBy('tgl_berita', 'desc')->paginate(3);

        //return collection of posts as a resource
        //return response()->json($berita);
        return new PostResource(true, 'List Data', $berita);
    }

    public function show($slug)
    {
        // Find post by slug
        $berita = Berita::with('user')->where('judul_seo', $slug)->firstOrFail();
        // Return single post as a resource
        return new PostResource(true, 'Detail Data!', $berita);
    }
}
