<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Http\Controllers\Controller;
use App\Model\Game\TopSeller;

class TopSellerController extends Controller
{
    public function index ()
    {
        $cc = Request::get('cc');
        if ($cc == 'cn') { $country = 'China'; }
        if ($cc == 'us') { $country = 'United States'; }
        return Cache::remember(Request::fullUrl(), 0, function () use ($country) {
            $firstData = TopSeller::where('Country', $country)->latest('LastUpdated')->first();
            return response()->json($firstData->Data);
        });
    }
}
