<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\MemberGroup;
use App\Models\GroupPesan;
use App\Models\Lainnya;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesanLainnyaOperatorController extends Controller
{
    public function member_group($id, $kat)
    {
        $member = MemberGroup::leftJoin('group_pesan', 'member_group.id_group', '=', 'group_pesan.id')
            ->select(
                'member_group.id',
                'member_group.nama',
                'member_group.no_hp',
                'group_pesan.nama_group',
            )
            ->where('member_group.id_group', $id)
            ->groupBy(
                'member_group.id',
                'member_group.nama',
                'member_group.no_hp',
                'group_pesan.nama_group',
            )
            ->get();

        $group = GroupPesan::where('kategori', $kat)->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'member' => $member,
                'group' => $group,
            ]
        ], 200);
    }

    public function detail_member($kat)
    {
        if ($kat == 'Lainnya') {
            $member = Lainnya::latest()->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'member' => $member,
            ]
        ], 200);
    }

    public function buat_group(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_group'     => 'required',
            'kategori'      => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create
        $post = GroupPesan::create([
            'nama_group' => $request->nama_group,
            'kategori'  => $request->kategori,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }

    public function tambah_member(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'no_hp'    => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create
        $post = MemberGroup::create([
            'id_group'  => $request->id_group,
            'nama'      => $request->nama,
            'no_hp'     => $request->no_hp,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }
}
