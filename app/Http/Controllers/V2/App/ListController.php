<?php

namespace App\Http\Controllers\V2\App;

use Request;
use Cache;
use App\Model\Game\App;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index() {
        $param = Request::get('param');
        $page = Request::get('page');
        return Cache::remember(Request::fullUrl(), 5, function () use ($param) {
            return App::with([
                        'AppType',
                        'AppPrice' => function ($query) {
                            $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
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
        return Cache::remember('AppID=' . $id, 30, function () use ($id) {
            return App::with([
                'AppType',
                'AppPrice' => function ($query) {
                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
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
