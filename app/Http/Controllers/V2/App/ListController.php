<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\App;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index() {
        $param = Request::get('param');
        $page = Request::get('page');
        $cc = Request::get('cc');
        if ($cc === 'cn') $country = 'cn';
        else if ($cc === 'us') $country = 'us';
        else $country = 'cn';
        return Cache::remember(Request::fullUrl(), 5, function () use ($param,  $country) {
            return App::with([
                        'AppType',
                        'AppPrice' => function ($query) use ($country) {
                            if ($country === 'cn')
                                $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                            else if ($country === 'us')
                                $query->where('Country', 'United States')->orderBy('LastUpdated', 'desc');
                        },
                        'AppInfo' => function ($query) {
                            $query->where('key', 116);
                            $query->orWhere('key', 117);
                        }])
                        ->whereNotIn('AppType', [0])
                        ->orderBy('LastUpdated', 'desc')
                        ->paginate($param);
        });
    }

    public function show($id) {
        $cc = Request::get('cc');
        if ($cc === 'cn') $country = 'cn';
        else if ($cc === 'us') $country = 'us';
        else $country = 'cn';
        return Cache::remember(Request::fullUrl(), 5, function () use ($id, $country) {
            return App::with([
                'AppType',
                'AppPrice' => function ($query) use ($country) {
                    if ($country === 'cn')
                        $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                    else if ($country === 'us')
                        $query->where('Country', 'United States')->orderBy('LastUpdated', 'desc');
                },
                'AppInfo' => function ($query) {
                    $query->where('key', 116);
                    $query->orWhere('key', 117);
                }])
                ->where('AppID', $id)
                ->orderBy('LastUpdated', 'desc')
                ->get();
        });
    }
}
