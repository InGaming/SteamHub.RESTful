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
        return Cache::remember(Request::fullUrl(), 60, function () use ($country) {
            return TopSeller::latest('Created')->limit(100)->get();
        });
    }
}
