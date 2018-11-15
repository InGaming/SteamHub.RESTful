<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\AppPrice;
use App\Http\Controllers\Controller;

class PriceController extends Controller
{
    public function index() {
        if (Request::get('math') === 'count') {
            return Cache::remember(Request::fullUrl(), 360, function () {
                return AppPrice::count();
            });
        }
    }

    public function show($id) {
        $count = Request::get('count');
        $cc = Request::get('cc');
        if ($cc === 'cn') $country = 'cn';
        else if ($cc === 'us') $country = 'us';
        else $country = 'cn';
        if ($count == 'min') {
            return Cache::remember(Request::fullUrl(), 360, function () use ($id, $country) {
                if ($country === 'cn')
                    return AppPrice::where('AppID', $id)->where('Country', 'China')->min('PriceFinal');
                if ($country === 'us')
                return AppPrice::where('AppID', $id)->where('Country', 'United States')->min('PriceFinal');
            });
        }
        return Cache::remember(Request::fullUrl(), 360, function () use ($id, $country) {
            if ($country === 'cn')
                return AppPrice::where('AppID', $id)->where('Country', 'China')->orderBy('LastUpdated', 'desc')->get();
            if ($country === 'us')
            return AppPrice::where('AppID', $id)->where('Country', 'United States')->orderBy('LastUpdated', 'desc')->get();
        });
    }
}
