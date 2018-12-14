<?php

namespace App\Http\Controllers\Dota\Zhushou\Log\Update;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Client $client
     * @return string
     */
    public function index(Client $client)
    {
        $xml_response
            = $client->get('http://sh-update.steamhub.cn/dota2/app/update/updatelist2.xml');

        $xml_load
            = simplexml_load_string($xml_response->getBody());

        return
            response()
                ->json($xml_load);
    }
}
