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

class PengumumanController extends Controller
{
    public function index()
    {
        //get all Pengumuman
        $pengumuman = Pengumuman::with('user')->orderBy('tgl_pengumuman', 'desc')->paginate(3);

        //return collection of Pengumuman as a resource
        return new PostResource(true, 'List Data Pengumuman', $pengumuman);
    }

    public function show($id)
    {
        //find post by ID
        $pengumuman = Pengumuman::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $pengumuman);
    }
}
