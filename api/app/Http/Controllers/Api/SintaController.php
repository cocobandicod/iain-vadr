<?php

namespace App\Http\Controllers\Api;
use App\Models\Sinta;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class SintaController extends Controller
{
    public function show($id)
    {
        $url1 = "https://sinta.kemdikbud.go.id/authors/profile/" . $id;
        $url2 = "https://sinta.kemdikbud.go.id/authors/profile/" . $id . "/?view=matrics";

        $client1 = new Client();
        $client2 = new Client();
        $response1 = $client1->request('GET', $url1);
        $response2 = $client2->request('GET', $url2);

        $html1 = $response1->getBody()->getContents();
        $html2 = $response2->getBody()->getContents();

        $crawler1 = new Crawler($html1);
        $crawler2 = new Crawler($html2);

        $scores1 = [];
        $scores2 = [];
        $scores3 = [];
        $crawler1->filter('.pr-num')->each(function (Crawler $node, $i) use (&$scores1) {
            $scores1[] = $node->text();
        });

        $crawler1->filter('.text-warning')->each(function (Crawler $node, $i) use (&$scores2) {
            $scores2[] = $node->text();
        });

        $crawler2->filter('.matriks-score-all')->each(function (Crawler $node, $i) use (&$scores3) {
            $scores3[] = $node->text();
        });

        return response()->json([
            'sinta_score' => $scores1[0],
            'y3r' => $scores1[1],
            'article' => $scores2[1],
            'citation' => $scores2[2],
            'hindex' => $scores2[4],
            'buku' => $scores3[222],
            'hki' => $scores3[268],
        ]);
        
    }

    public function update(Request $request, $id_user)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'sinta_score' => 'required',
            'y3r' => 'required',
            'article' => 'required',
            'citation' => 'required',
            'hindex' => 'required',
            'buku' => 'required',
            'hki' => 'required',
        ]);
        
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        //find post by ID
        //$sinta = Sinta::find($id_user);
        $sinta = Sinta::where('id_user', $id_user)->first();

        //update
        $sinta->update([
            'sinta_score' => $request->sinta_score,
            'y3r'         => $request->y3r,
            'article'    => $request->article,
            'citation'   => $request->citation,
            'hindex'     => $request->hindex,
            'buku'       => $request->buku,
            'hki'        => $request->hki,
        ]);

        //return response
        return new PostResource(true, 'Sukses', $sinta);
    }
}
