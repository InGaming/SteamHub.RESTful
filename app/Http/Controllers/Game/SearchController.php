<?php

namespace App\Http\Controllers\Game;

use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Validation\Rule;
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
            $queryTag = AppTag::query();
            $queryTagName = $queryTag->distinct()->pluck('Tag');
            Validator::make($request->all(), [
            'type.*' => [
                'nullable',
                Rule::in($queryTagName),
            ],
            'price.*' => [
                'nullable',
                Rule::in(['0,3000', '3000,10000', '10000,15000', '15000,300000']),
            ],
            'q' => [
                'filled',
            ],
            ])->validate();
            return $this->query($query_name, $price, $type);
        });
    }

    public function query($query_name, $price, $type) {
        
        if ($price[0]) {
            $unique_price = collect($price)->unique()->values()->all();
        } else {
            $unique_price = ['0, 999900'];
        }

        $appPrice = AppPrice::query();
        $appTag = AppTag::query();
        
        $app = App::where(function($query) use ($query_name) {
            $query->where('AppID', 'like', '%' . $query_name . '%')
                ->orWhere('Name', 'like', '%' . $query_name . '%')
                ->orWhere('ChineseName', 'like', '%' . $query_name . '%')
                ->orWhere('Nickname', 'like', '%' . $query_name . '%')
                ->orWhere('DetailedDescription', 'like', '%' . $query_name . '%')
                ->orWhere('ShortDescription', 'like', '%' . $query_name . '%')
                ->whereNotIn('AppType', [0]);
        });

        foreach ($unique_price as $key=>$field) {
            $data[$key] = $app->whereHas('AppPrice', function ($query) use ($field) {
                $query->whereBetween('PriceInitial', explode(',', $field))->where('Country', 'China')->whereNotNull('PriceInitial');
            })
            ->with([
                'AppPrice' => function ($query) use ($field) {
                    $query->where('Country', 'China')->orderBy('LastUpdated', 'desc');
                }
            ])
            ->when($type[0], function ($query) use ($type) {
                $query->whereHas('AppTag', function ($query) use ($type) {
                    $query->whereIn('Tag', $type);
                });
            })
            ->with([
                'AppTag' => function ($query) {
                    $query->orderBy('LastUpdated', 'desc');
                }
            ])
            ->orderBy('LastUpdated', 'desc')
            ->paginate();
        }
        return $data;
    }
}

