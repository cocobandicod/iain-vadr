<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\MemberGroup;
use App\Models\GroupPesan;
use App\Models\Lainnya;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pegawai;
use App\Models\ReportPesan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{

    public function group($kat)
    {
        $group = GroupPesan::leftJoin('member_group', 'group_pesan.id', '=', 'member_group.id_group')
            ->select(
                'group_pesan.kode',
                'group_pesan.nama_group',
                'group_pesan.kategori',
                'group_pesan.created_at',
                DB::raw('COUNT(member_group.id) as jumlah_member')
            )
            ->where('group_pesan.kategori', $kat)
            ->groupBy(
                'group_pesan.kode',
                'group_pesan.nama_group',
                'group_pesan.kategori',
                'group_pesan.created_at',
            )
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'group' => $group,
            ]
        ], 200);
    }

    public function detail_group($kode)
    {

        $group = GroupPesan::where('kode', $kode)->first();

        if (!$group) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404); // Return 404 error if berita not found
        }

        return new PostResource(true, 'List Data', $group);
    }

    public function add_group(Request $request)
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
            'kode'       => strtoupper(Str::random(8)),
            'nama_group' => $request->nama_group,
            'kategori'   => $request->kategori,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }

    public function update_group(Request $request, $kode)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_group' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $group = GroupPesan::where('kode', $kode)->first();

        //update
        $group->update([
            'nama_group' => $request->nama_group,
        ]);

        //return response
        return new PostResource(true, 'Sukses', $group);
    }

    public function hapus_group($kode)
    {
        // Cari grup berdasarkan kode
        $group = GroupPesan::select('id')
            ->where('kode', $kode)
            ->first();

        // Jika grup tidak ditemukan, kembalikan response error
        if (!$group) {
            return response()->json(['success' => false, 'message' => 'Group tidak ditemukan!'], 404);
        }

        // Hapus semua anggota yang terkait dengan grup tersebut
        MemberGroup::where('id_group', $group->id)->delete();

        // Hapus grup itu sendiri
        $group->delete();

        // Kembalikan response sukses
        return response()->json(['success' => true, 'message' => 'Data Berhasil Dihapus!']);
    }

    public function group_member($kat, $kode)
    {
        // Cari grup berdasarkan kode
        $group = GroupPesan::select('id', 'nama_group')
            ->where('kode', $kode)
            ->first();

        // Jika grup tidak ditemukan, kembalikan response error
        if (!$group) {
            return response()->json([
                'success' => false,
                'message' => 'Group tidak ditemukan!',
            ], 404);
        }

        // Ambil data member yang terkait dengan grup
        $member = MemberGroup::select(
            'member_group.id',
            'member_group.nama',
            'member_group.no_hp',
            'member_group.created_at'
        )
            ->where('member_group.id_group', $group->id)
            ->get();

        // Hitung jumlah member yang terkait dengan grup
        $jumlahMember = MemberGroup::where('id_group', $group->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'member' => $member,
                'group'  => $group,
                'jum'    => $jumlahMember, // Hasil perhitungan jumlah member
            ]
        ], 200);
    }

    public function add_member(Request $request)
    {
        $members = $request->input('members');
        $id_group = $request->input('id_group');

        foreach ($members as $member) {
            MemberGroup::create([
                'id_group' => $id_group,
                'nama' => $member['nama'],
                'no_hp' => $member['no_hp'],
            ]);
        }

        return response()->json(['message' => 'Data Berhasil Ditambahkan!'], 200);
    }

    public function hapus_member($id)
    {

        //find post by ID
        $member = MemberGroup::where('id', $id)->first();


        //delete post
        $member->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }

    public function detail_member($kat, $id)
    {
        if ($kat == 'Lainnya') {
            //$list = Lainnya::select('id', 'nama_lainnya', 'no_hp')->latest()->get();
            $list = Lainnya::leftJoin('member_group', function ($join) use ($id) {
                $join->on('lainnya.no_hp', '=', 'member_group.no_hp')
                    ->where('member_group.id_group', '=', $id);
            })
                ->select('lainnya.id', 'lainnya.nama_lainnya as nama', 'lainnya.no_hp')
                ->whereNull('member_group.no_hp')
                ->groupBy('lainnya.id', 'lainnya.nama_lainnya', 'lainnya.no_hp')
                ->get();
        } else if ($kat == 'Mahasiswa') {
            $list = Mahasiswa::leftJoin('member_group', function ($join) use ($id) {
                $join->on('mahasiswa.no_hp', '=', 'member_group.no_hp')
                    ->where('member_group.id_group', '=', $id);
            })
                ->select('mahasiswa.id', 'mahasiswa.nama_mahasiswa as nama', 'mahasiswa.no_hp')
                ->whereNull('member_group.no_hp')
                ->groupBy('mahasiswa.id', 'mahasiswa.nama_mahasiswa', 'mahasiswa.no_hp')
                ->get();
        } else if ($kat == 'Dosen') {
            $list = Dosen::leftJoin('member_group', function ($join) use ($id) {
                $join->on('dosen.no_hp', '=', 'member_group.no_hp')
                    ->where('member_group.id_group', '=', $id);
            })
                ->select('dosen.id', 'dosen.nama_dosen as nama', 'dosen.no_hp')
                ->whereNull('member_group.no_hp')
                ->groupBy('dosen.id', 'dosen.nama_dosen', 'dosen.no_hp')
                ->get();
        } else if ($kat == 'Pegawai') {
            $list = Pegawai::leftJoin('member_group', function ($join) use ($id) {
                $join->on('pegawai.no_hp', '=', 'member_group.no_hp')
                    ->where('member_group.id_group', '=', $id);
            })
                ->select('pegawai.id', 'pegawai.nama_pegawai as nama', 'pegawai.no_hp')
                ->whereNull('member_group.no_hp')
                ->groupBy('pegawai.id', 'pegawai.nama_pegawai', 'pegawai.no_hp')
                ->get();
        } else if ($kat == 'Orangtua') {
            $list = Mahasiswa::leftJoin('member_group', function ($join) use ($id) {
                $join->on('mahasiswa.no_hp', '=', 'member_group.no_hp')
                    ->where('member_group.id_group', '=', $id);
            })
                ->select('mahasiswa.id', 'mahasiswa.nama_mahasiswa as nama', 'mahasiswa.no_hp_orangtua as no_hp')
                ->whereNull('member_group.no_hp')
                ->groupBy('mahasiswa.id', 'mahasiswa.nama_mahasiswa', 'mahasiswa.no_hp_orangtua')
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sukses',
            'data' => [
                'list'   => $list,
            ]
        ], 200);
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

    public function kirim_broadcast(Request $request)
    {
        // Get id_group and message body from the request
        $id_group = $request->input('id_group');
        $body = $request->input('body');

        // Fetch all members in the group
        $members = MemberGroup::where('id_group', $id_group)->select('nama', 'no_hp')->get();

        // Prepare payload for Wablas API
        $data = [];
        foreach ($members as $member) {
            $data[] = [
                'phone' => '62' . substr($member->no_hp, 1), // Convert to international format
                'message' => $body,
            ];
        }

        // Token Wablas API
        $token = env('WABLAS_API_TOKEN'); // Simpan token di .env
        $payload = [
            'data' => $data
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: $token",
            "Content-Type: application/json"
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);

        // Check if the response is successful
        if ($response['status'] && isset($response['data']['messages'])) {
            foreach ($response['data']['messages'] as $message) {
                // Insert each message into the report_pesan table
                DB::table('report_pesan')->insert([
                    'id_group' => $id_group,
                    'id_pesan' => $message['id'],
                    'no_hp' => $message['phone'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Broadcast berhasil dikirim.',
                'data' => $response
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Broadcast gagal dikirim.',
                'error' => $response
            ], 500);
        }
    }

    public function kirim_broadcast2(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_group' => 'required|integer',
            'body' => 'required|string',
        ]);

        // Ambil anggota berdasarkan id_group
        $members = MemberGroup::where('id_group', $request->id_group)->get();

        // Jika tidak ada anggota di grup, kembalikan pesan error
        if ($members->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada anggota di grup ini.',
            ], 400);
        }

        // Siapkan payload untuk Wablas API
        $data = [];
        foreach ($members as $member) {
            $data[] = [
                'phone' => '62' . substr($member->no_hp, 1),  // Pastikan nomor diawali dengan kode negara '62'
                'message' => $request->body,
            ];
        }

        $payload = [
            'data' => $data
        ];

        // Token Wablas API
        $token = env('WABLAS_API_TOKEN'); // Simpan token di .env

        // Inisiasi curl untuk mengirimkan permintaan ke Wablas API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: $token",
            "Content-Type: application/json"
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        // Eksekusi curl dan dapatkan hasilnya
        $result = curl_exec($curl);
        curl_close($curl);

        // Cek hasil dari Wablas API
        $response = json_decode($result, true);

        if (isset($response['status']) && $response['status'] === true) {
            return response()->json([
                'success' => true,
                'message' => 'Broadcast berhasil dikirim.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim broadcast.',
                'error' => $response['message'] ?? 'Unknown error',
            ], 500);
        }
    }

    public function report_pesan($kat, Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 100);

        if ($kat == 'Lainnya') {
            // Ambil data dari report_pesan dengan relasi
            $reportPesan = ReportPesan::with(['Lainnya', 'GroupPesan'])
                ->select('id_group', 'id_pesan', 'no_hp', 'created_at')
                ->whereNotNull('id_pesan')
                ->paginate($limit, ['*'], 'page', $page);

            $messageIds = $reportPesan->pluck('id_pesan')->toArray();

            // Jika tidak ada pesan yang ditemukan
            if (empty($messageIds)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Tidak ada pesan yang ditemukan',
                    'data' => []
                ], 200);
            }

            $token = env('WABLAS_API_TOKEN');
            $message_id = implode(',', $messageIds);

            // Mengambil laporan dari API Wablas
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                "Authorization: $token",
            ]);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/report-realtime?page=$page&message_id=$message_id&limit=$limit");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

            $result = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($result, true);

            if (isset($response['data']) && is_array($response['data']) && !empty($response['data'])) {
                $data = [];

                foreach ($response['data'] as $message) {
                    $noHpInternational = $message['phone']['to'];
                    $noHpLokal = '0' . substr($noHpInternational, 2);

                    // Ambil nama dari tabel lainnya berdasarkan no_hp
                    $namaMember = Lainnya::where('no_hp', $noHpLokal)->value('nama_lainnya');

                    // Ambil item report_pesan berdasarkan id_pesan
                    $reportPesanItem = $reportPesan->firstWhere('id_pesan', $message['id']);

                    // Jika id_group = 0, tampilkan status "Kirim Personal"
                    if ($reportPesanItem->id_group == 0) {
                        $namaGroup = 'Kirim Personal';
                    }
                    // Jika id_group tidak 0, cek apakah ada relasi groupPesan
                    elseif ($reportPesanItem->groupPesan) {
                        $namaGroup = $reportPesanItem->groupPesan->nama_group;
                    }
                    // Jika id_group tidak ditemukan di group_pesan, lanjut ke pesan berikutnya
                    else {
                        continue;
                    }

                    $data[] = [
                        'nama' => $namaMember,
                        'nama_group' => $namaGroup,
                        'tanggal_kirim' => $message['date']['created_at'],
                        'no_hp' => $message['phone']['to'],
                        'status' => $message['status'],
                    ];
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diambil',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Tidak ada data yang ditemukan dari API',
                    'data' => []
                ], 200);
            }
        }
    }


    public function kirim_pesan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'body' => 'required|string',
        ]);

        // Ambil data dari request
        $nama = $request->input('nama');
        $no_hp = $request->input('no_hp');
        $body = $request->input('body');

        // Ubah format nomor telepon dari 08 ke 628
        $phone = '62' . substr($no_hp, 1);

        // Token Wablas API
        $token = env('WABLAS_API_TOKEN'); // Simpan token di .env

        // Kirim pesan menggunakan Wablas API
        $curl = curl_init();
        $message = urlencode($body); // Encode message to URL format
        curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/send-message?phone=$phone&message=$message&token=$token");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        // Decode response dari Wablas API
        $response = json_decode($result, true);

        if ($response['status'] && isset($response['data']['messages'])) {
            foreach ($response['data']['messages'] as $message) {
                // Insert each message into the report_pesan table
                DB::table('report_pesan')->insert([
                    'id_group' => 0,
                    'id_pesan' => $message['id'],
                    'no_hp' => $message['phone'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Broadcast berhasil dikirim.',
                'data' => $response
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Broadcast gagal dikirim.',
                'error' => $response
            ], 500);
        }
    }
}
