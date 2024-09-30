<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Panduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PanduanController extends Controller
{

    public function index()
    {
        //get all Pengumuman
        $panduan = Panduan::latest()->get();

        //return collection of Pengumuman as a resource
        return new PostResource(true, 'List Data Panduan', ['data' => $panduan]);
    }

    public function show($id)
    {
        //find post by ID
        $pengumuman = Panduan::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $pengumuman);
    }

    /*
    public function show($id)
    {
        // Find post by slug
        $pengumuman = Pengumuman::where('judul_seo', $slug)->firstOrFail();

        // Return single Pengumuman as a resource
        return new PostResource(true, 'Detail Data Pengumuman!', $pengumuman);
    }
    */
}
