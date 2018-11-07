<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Http\Controllers\Controller;
use App\Model\Game\Trending;

class TrendingController extends Controller
{
    public function index ()
    {
        return Cache::remember(Request::fullUrl(), 1, function () {
            $data = Trending::latest('LastUpdated')->limit(100);
            return $data;
        });
    }
}
