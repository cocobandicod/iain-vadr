<?php

namespace App\Http\Controllers\Api;

//import Model "User"
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        //get all register
        $register = User::latest()->paginate(5);

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Register', $register);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required',
            'username'   => 'required',
            'password'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create register
        $register = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
        ]);

        //return response
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $register);
    }
}
