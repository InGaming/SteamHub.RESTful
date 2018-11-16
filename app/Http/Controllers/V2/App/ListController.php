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

        return Cache::remember(Request::fullUrl(), 5, function () use ($param) {
            if (Request::get('math') === 'count') {
                return App::count();
            }
            return App::with([
                'AppType',
                'AppTag',
                'AppPrice' => function ($query) {
                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                },
            ])
            ->whereNotIn('AppType', [0])
            ->when(Request::get('type') === 'high-score', function ($query) {
                return $query->orderBy('Metacritic', 'desc');
            })
            ->orderBy('LastUpdated', 'desc')
            ->paginate($param);
        });
    }

    public function show($id) {
        return Cache::remember(Request::fullUrl(), 5, function () use ($id) {
            return App::with([
                'AppType',
                'AppPrice' => function ($query) use ($country) {
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
