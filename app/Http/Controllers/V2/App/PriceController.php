<?php

namespace App\Http\Controllers\V2\App;

use Request;
use Cache;
use App\Model\Game\AppPrice;
use App\Http\Controllers\Controller;

class PriceController extends Controller
{
    public function show($id) {
        $count = Request::get('count');
        if ($count == 'min') {
            return Cache::remember('AppPriceMinID=' . $id, 360, function () use ($id) {
                return AppPrice::where('AppID', $id)->where('Country', 'China')->min('PriceFinal');
            });
        }
        return Cache::remember('AppPriceID=' . $id, 360, function () use ($id) {
            return AppPrice::where('AppID', $id)->where('Country', 'China')->orderBy('LastUpdated', 'desc')->get();
        });
    }
}
