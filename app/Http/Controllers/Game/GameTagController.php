<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameTag as GameTagResources;
use App\Http\Requests\Game\GameTagQuery;
use App\Model\Game\GameTag as GameTagModel;
use Illuminate\Http\Request;

class GameTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GameTagResources
     */
    public function index(GameTagQuery $request, GameTagModel $gameTagModel)
    {
        $q = $request->q;
        $appids = $request->appids;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;

        $query =
            $gameTagModel
                ->with(['game_list'])
                ->when($q, function ($query) use ($q) {
                    return $query->where('tag', $q);
                })
                ->when($appids, function ($query) use ($appids) {
                    $array_appids = array_map('intval', explode(',', $appids));
                    return $query->whereIn('appid', $array_appids);
                })
                ->when($order_field && $order, function ($query) use ($order_field, $order) {
                    return $query->orderBy($order_field, $order);
                })
                ->when($simple_paginate, function ($query) use ($length) {
                    return $query->simplePaginate($length);
                }, function ($query) use ($length) {
                    return $query->paginate($length);
                });
        return new GameTagResources($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
