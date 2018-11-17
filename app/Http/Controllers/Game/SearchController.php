<?php

namespace App\Http\Controllers\Game;

use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Model\Game\App;
use App\Model\Game\AppPrice;
use App\Model\Game\AppTag;

class SearchController extends Controller
{
    public function index(Request $request) {
        return Cache::remember($request->fullUrl(), 1440, function () use ($request) {
            $type = $request->type;
            $price = $request->price;
            $query_name = $request->q[0];
            return $this->query($query_name, $price, $type);
        });
    }

    public function query($query_name, $price, $type) {

        $app = App::query();
        
        if ($query_name) {
            $appid = $app->where('AppID', 'like', '%' . $query_name . '%')
            ->orWhere('Name', 'like', '%' . $query_name . '%')
            ->orWhere('ChineseName', 'like', '%' . $query_name . '%')
            ->orWhere('Nickname', 'like', '%' . $query_name . '%')
            ->orWhere('DetailedDescription', 'like', '%' . $query_name . '%')
            ->orWhere('ShortDescription', 'like', '%' . $query_name . '%')
            ->whereNotIn('AppType', [0])
            ->distinct()
            ->pluck('AppID');
        } else {
            $appid = false;
        }

        if ($price[0]) {
            $unique_price = collect($price)->unique()->values()->all();
        } else {
            $unique_price = ['0, 999900'];
        }


        if ($appid) {
            $appPrice = AppPrice::whereIn('AppID', $appid);
        } else {
            $appPrice = AppPrice::query();
        }
        
        $appTag = AppTag::query();
        
        foreach ($unique_price as $key=>$field) {
            $appPriceId = $appPrice
            ->where('Country', 'China')
            ->whereBetween('PriceInitial', explode(',', $field))
            ->distinct()
            ->pluck('AppID');

            $appTagId = $appTag
            ->when($type[0], function ($query) use ($type) {
                $query->whereIn('Tag', $type);
            })
            ->whereIn('AppID', $appPriceId)
            ->distinct()
            ->pluck('AppID');

            $data[$key] = $app
            ->whereIn('AppID', $appTagId)
            ->with([
                'AppPrice' => function ($query) {
                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                }, 
                'AppTag' => function ($query) {
                    $query->orderBy('LastUpdated', 'desc');
                }, 
                'AppReview' => function ($query) {
                    $query->orderBy('LastUpdated', 'desc');
                },
            ])
            ->orderBy('LastUpdated', 'desc')
            ->paginate();
        }
        return $data;
    }
}

