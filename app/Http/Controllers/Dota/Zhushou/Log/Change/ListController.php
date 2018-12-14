<?php

namespace App\Http\Controllers\Dota\Zhushou\Log\Change;

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
            = $client->get('http://sh-update.steamhub.cn/dota2/app/update/updatelog.xml');

        $xml_load
            = simplexml_load_string($xml_response->getBody());

        $xml_parse_str
            = json_encode($xml_load);

        $xml_parse_array
            = json_decode($xml_parse_str, true);

        return array_reverse($xml_parse_array['ver']);
    }
}
