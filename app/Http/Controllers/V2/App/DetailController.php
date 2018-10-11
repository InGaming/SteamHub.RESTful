<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\AppDetail;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function show($id) {
        $lang = Request::get('lang');
        return Cache::remember(Request::fullUrl(), 720, function () use ($id, $lang) {
            $firstData = AppDetail::where('AppID', $id)->where('Language', $lang)->first();
            return response()->json($firstData);
        });
    }
}
