<?php

namespace App\Http\Controllers\Game;

use Request;
use Cache;
use App\Http\Controllers\Controller;

use App\Model\Game\App as App;
use App\Model\Game\AppHistory;
use App\Model\Game\AppInfo;
use App\Model\Game\AppPrice;
use App\Model\Game\AppType;
use App\Model\Game\AppUpdateQueue;

class SearchController extends Controller
{
    public function index ($model, $method, $action, $param = null, $filter = null) {
        switch ($model) {
            case 'app':
                switch ($method) {
                    case 'list':
                        switch ($action) {
                            case 'all':
                                return Cache::remember('AppListPage=' . Request::get('page') . '&paginate=' . $param, 5, function () use ($param) {
                                    return App::with([
                                                'AppType',
                                                'AppPrice' => function ($query) {
                                                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                                                },
                                                'AppInfo' => function ($query) {
                                                    $query->where('key', 116);
                                                    $query->orWhere('key', 117);
                                                }])
                                            ->orderBy('LastUpdated', 'desc')
                                            ->paginate($param);
                                });
                            
                            case 'count':
                                return Cache::remember('AppListCount', 5, function () {
                                    return App::count();
                                }

                            case 'latest':
                                return Cache::remember('AppListLastUpdated', 5, function () {
                                    return App::latest('LastUpdated')->firstOrFail();
                                }

                            case 'view':
                                switch ($filter) {
                                    case 'price':
                                        switch (Request::get('country')) {
                                            case 'cn':
                                                switch (Request::get('math')) {
                                                    case 'min':
                                                        return AppPrice::where('AppID', $param)->where('Country', 'China')->min('PriceFinal');

                                                }
                                                return AppPrice::where('AppID', $param)->where('Country', 'China')->orderBy('LastUpdated', 'desc')->get();
                                            
                                            case 'us':
                                                switch (Request::get('math')) {
                                                    case 'min':
                                                        return AppPrice::where('AppID', $param)->where('Country', 'United States')->min('PriceFinal');

                                                }
                                                return AppPrice::where('AppID', $param)->where('Country', 'United States')->orderBy('LastUpdated', 'desc')->get();

                                            case 'uk':
                                                switch (Request::get('math')) {
                                                    case 'min':
                                                        return AppPrice::where('AppID', $param)->where('Country', 'United Kingdom')->min('PriceFinal');

                                                }
                                                return AppPrice::where('AppID', $param)->where('Country', 'United Kingdom')->orderBy('LastUpdated', 'desc')->get();

                                            case 'ru':
                                                switch (Request::get('math')) {
                                                    case 'min':
                                                        return AppPrice::where('AppID', $param)->where('Country', 'Russia')->min('PriceFinal');

                                                }
                                                return AppPrice::where('AppID', $param)->where('Country', 'Russia')->orderBy('LastUpdated', 'desc')->get();

                                            default:
                                                return AppPrice::where('AppID', $param)->orderBy('LastUpdated', 'desc')->get();
                                        }
                                    
                                    
                                }
                            
                        }
                    
                    case 'update_queue':
                        switch ($action) {
                            case 'all':
                                return Cache::remember('AppUpdateQueueListPage=' . Request::get('page') . '&paginate=' . $param, 5, function () use ($param) {
                                    return AppUpdateQueue::orderBy('ID', 'desc')->paginate($param);
                                }
                            
                            case 'count':
                                return Cache::remember('AppUpdateQueueCount', 5, function () {
                                    return AppUpdateQueue::count();
                                }
                                
                            case 'latest':
                                return Cache::remember('AppUpdateQueueLatest', 5, function () {
                                    return AppUpdateQueue::orderBy('ID', 'desc')->firstOrFail();
                                }
                                
                        }
                        break;
                }
                break;
        }
    }
}

