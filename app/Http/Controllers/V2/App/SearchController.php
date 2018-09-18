<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\App;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    function __construct() {
        $requestQuery = Request::query();

        if (array_key_exists('param', $requestQuery) && !is_null($requestQuery['param']))
            $this->param = $requestQuery['param'];
        else
            $this->param = NULL;

        if (array_key_exists('q', $requestQuery) && !is_null($requestQuery['q']))
            $this->q = $requestQuery['q'];
        else
            $this->q = NULL;

    }

    public function index() {
        $param = $this->param;
        $q = $this->q;
        return Cache::remember(Request::fullUrl(), 360, function () use ($param, $q) {
            return App::with([
                        'AppType',
                        'AppPrice' => function ($query) {
                            $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                        },
                        'AppInfo' => function ($query) use ($q) {
                            $query->where('Key', 116);
                            $query->orWhere('Value', 'like', '%' . $q . '%');
                            $query->orWhere('Key', 117);
                        }])
                        ->where('AppID', 'like', '%' . $q . '%')
                        ->orWhere('Name', 'like', '%' . $q . '%')
                        ->orWhere('ChineseName', 'like', '%' . $q . '%')
                        ->orWhere('Nickname', 'like', '%' . $q . '%')
                        ->orWhere('DetailedDescription', 'like', '%' . $q . '%')
                        ->orWhere('ShortDescription', 'like', '%' . $q . '%')
                        ->whereNotIn('AppType', [0])
                        ->orderBy('AppID', 'asc')
                        ->paginate($param);
        });
    }
}
