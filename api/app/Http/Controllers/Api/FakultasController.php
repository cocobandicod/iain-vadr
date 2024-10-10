<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Fakultas;
use App\Models\Jurusan;

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

class FakultasController extends Controller
{

    // Mendapatkan semua provinsi
    public function getFakultas()
    {
        $post = Fakultas::all();
        return response()->json($post);
    }

    // Mendapatkan kabupaten/kota berdasarkan id_provinsi
    public function getJurusan($id)
    {
        $post = Jurusan::where('id_jurusan', $id)->get();
        return response()->json($post);
    }
}
