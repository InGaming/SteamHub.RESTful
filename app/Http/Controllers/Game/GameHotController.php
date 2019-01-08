<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Game\GameHot as GameHotModel;
use App\Http\Requests\Game\GameHotQuery;
use App\Http\Resources\Game\GameHot as GameHotResources;
use phpDocumentor\Reflection\Types\String_;

class GameHotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GameHotQuery $request
     * @param GameHotModel $GameHotModel
     * @return GameHotResources
     */
    public function index(GameHotQuery $request, GameHotModel $GameHotModel)
    {
        $q = $request->q;
        $appids = $request->appids;
        $current = $request->current;
        $total = $request->total;
        $date = $request->date;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;

        $query =
            $GameHotModel
                ->with(['game_list', 'game_prices', 'game_tags'])
                ->when($appids, function ($query) use ($appids) {
                    $array_appids = array_map('intval', explode(',', $appids));
                    return $query->whereIn('appid', $array_appids);
                })
                ->when($q, function ($query) use ($q) {
                    return $query->where('name', 'like', '%'.$q.'%');
                    })
                ->when($current, function ($query) use ($current) {
                    $array_current = array_map('intval', explode(',', $current));
                    return $query->whereBetween('current', [$array_current[0], $array_current[1]]);
                })
                ->when($total, function ($query) use ($total) {
                    $array_total = array_map('intval', explode(',', $total));
                    return $query->whereBetween('total', [$array_total[0], $array_total[1]]);
                })
                ->when($date, function ($query) use ($date) {
                    $array_date = array_map('intval', explode(',', $date));
                    return $query->whereBetween('created_at', [$array_date[0], $array_date[1]]);
                })
                ->when($order_field && $order, function ($query) use ($order_field, $order) {
                    return $query->orderBy($order_field, $order);
                })
                ->when($simple_paginate, function ($query) use ($length) {
                    return $query->simplePaginate ($length);
                }, function ($query) use ($length) {
                    return $query->paginate($length);
                });
        $data = new GameHotResources($query);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param GameHotModel $GameHotModel
     * @param  String_ $appids
     * @return GameHotResources
     */
    public function show(GameHotModel $GameHotModel, $appids)
    {
        $array_appids = array_map('intval', explode(',', $appids));
        $query = $GameHotModel->find($array_appids);
        $data = new GameHotResources($query);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
