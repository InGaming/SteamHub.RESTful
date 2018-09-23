<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function show($id) {
        $lang = Request::get('lang');
        if ($lang === 'schinese') $l = $lang;
        else if ($lang === 'english') $l = $lang;
        else $l = 'schinese';
        return Cache::remember(Request::fullUrl(), 360, function () use ($id, $l) {
            $client = new Client([
                'base_uri' => 'http://localhost',
                'timeout'  => 10.0,
            ]);
            $response = $client->request('GET', 'https://store.steampowered.com/api/appdetails?appids=' . $id . '&l=' . $l);
            return json_decode((string) $response->getBody(), true);
        });
    }
}
