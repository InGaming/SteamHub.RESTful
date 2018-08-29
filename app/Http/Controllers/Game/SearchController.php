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
    public function index ($model, $method, $action, $param = null) {
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
                                break;
                            
                            case 'count':
                                return App::count();
                                
                            case 'latest':
                                return App::latest('LastUpdated')->first();

                            case 'view':
                                return App::with([
                                'AppType',
                                'AppPrice' => function ($query) {
                                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                                },
                                'AppInfo' => function ($query) {
                                    $query->where('key', 116);
                                }])
                                ->where('Appid', $param)->firstOrFail();
                        }
                    
                    case 'update_queue':
                        switch ($action) {
                            case 'all':
                                return AppUpdateQueue::orderBy('ID', 'desc')->paginate($param);

                            case 'count':
                                return AppUpdateQueue::count();
                                break;
                            
                            case 'latest':
                                return AppUpdateQueue::orderBy('ID', 'desc')->firstOrFail();
                        }
                        break;
                }
                break;
        }
    }
}

