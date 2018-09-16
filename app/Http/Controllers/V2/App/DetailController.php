<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function show($id) {
        return Cache::remember(Request::fullUrl(), 360, function () use ($id) {
            $client = new Client([
                'base_uri' => 'http://localhost',
                'timeout'  => 10.0,
            ]);
            $response = $client->request('GET', 'https://store.steampowered.com/api/appdetails?appids=' . $id . '&l=schinese');
            return json_decode((string) $response->getBody(), true);
        });
    }
}
