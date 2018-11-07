<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Carbon;
use Request;
use App\Http\Controllers\Controller;
use App\Model\Game\Trending;

class TrendingController extends Controller
{
    public function index ()
    {
        return Cache::remember(Request::fullUrl(), 5, function () {
            return Trending::latest('Created')->orderBy('Now', 'desc')->limit(100)->get();

            // 
            if (Request::get('type') == 'total' && Request::get('count') == 'max' && Request::get('date') == 'today') {
                return Trending::whereDate('Created', Carbon::today())->orderBy('Total', 'desc')->unique('AppID')->all();
            }
        });
    }
}
