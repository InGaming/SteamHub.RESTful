<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Model\Game\Trending;

class TrendingController extends Controller
{
    public function index()
    {
        return Cache::remember(Request::fullUrl(), 5, function () {
            // 
            if (Request::get('type') == 'total' && Request::get('count') == 'max' && Request::get('date') == 'today') {
                return Trending::whereDate('Created', Carbon::today())->orderBy('Total', 'desc')->get()->unique('AppID')->values()->all();
            } else {
                return Trending::latest('Created')->orderBy('Now', 'desc')->limit(100)->get();
            }
        });
    }

    public function show($id)
    {
        return Cache::remember(Request::fullUrl(), 5, function () use ($id) {
            return Trending::where('AppID', $id)->orderBy('Now', 'asc')->get();
        });
    }
}
