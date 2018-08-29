<?php

namespace App\Http\Controllers\Game;

use Request;
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
                                return App::with([
                                'AppType',
                                'AppPrice' => function ($query) {
                                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                                },
                                'AppInfo' => function ($query) {
                                    $query->where('key', 116);
                                }])
                                ->orderBy('LastUpdated', 'desc')
                                ->paginate($param);
                            
                            case 'count':
                                return App::count();
                                
                            case 'latest':
                                return App::latest('LastUpdated')->first();

                            case 'view':
                                switch ($filter) {
                                    case 'price':
                                        switch (Request::get('country')) {
                                            case 'cn':
                                                return AppPrice::where('AppID', $param)->where('Country', 'China')->orderBy('LastUpdated', 'desc')->get();
                                            
                                            case 'us':
                                                return AppPrice::where('AppID', $param)->where('Country', 'United States')->orderBy('LastUpdated', 'desc')->get();

                                            case 'uk':
                                                return AppPrice::where('AppID', $param)->where('Country', 'United Kingdom')->orderBy('LastUpdated', 'desc')->get();

                                            case 'ru':
                                                return AppPrice::where('AppID', $param)->where('Country', 'Russia')->get();

                                            default:
                                                return AppPrice::where('AppID', $param)->get();
                                        }
                                        break;
                                }
                        }
                    
                    case 'update_queue':
                        switch ($action) {
                            case 'all':
                                return AppUpdateQueue::orderBy('ID', 'desc')->paginate($param);

                            case 'count':
                                return AppUpdateQueue::count();
                            
                            case 'latest':
                                return AppUpdateQueue::orderBy('ID', 'desc')->firstOrFail();
                        }
                        break;
                }
                break;
        }
    }
}

