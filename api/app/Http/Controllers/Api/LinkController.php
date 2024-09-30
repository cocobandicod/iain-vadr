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

class LinkController extends Controller
{
    public function index()
    {
        //get all Pengumuman
        $link = Link::latest()->get();

        //return collection of Pengumuman as a resource
        return new PostResource(true, 'List Data', ['data' => $link]);
    }
}
