<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Game\GamePrice as GamePriceModel;
use App\Http\Requests\Game\GamePriceQuery;
use App\Http\Resources\Game\GamePrice as GamePriceResources;
use phpDocumentor\Reflection\Types\String_;

class GamePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GamePriceQuery $request
     * @param GamePriceModel $gamePriceModel
     * @return GamePriceResources
     */
    public function index(GamePriceQuery $request, GamePriceModel $gamePriceModel)
    {
        $appids = $request->appids;
        $country = $request->country;
        $final = $request->final;
        $initial = $request->initial;
        $discount = $request->discount;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;

        $query =
            $gamePriceModel
                ->with(['game_list'])
                    ->when($appids, function ($query) use ($appids) {
                    $array_appids = array_map('intval', explode(',', $appids));
                    return $query->whereIn('appid', $array_appids);
                })
                ->when($country, function ($query) use ($country) {
                    return $query->whereCountry($country);
                    })
                ->when($final, function ($query) use ($final) {
                    return $query->whereFinal($final);
                })
                ->when($initial, function ($query) use ($initial) {
                    return $query->whereInitial($initial);
                })
                ->when($discount, function ($query) use ($discount) {
                    return $query->whereDiscount($discount);
                })
                ->when($order_field && $order, function ($query) use ($order_field, $order) {
                    return $query->orderBy($order_field, $order);
                })
                ->when($simple_paginate, function ($query) use ($length) {
                    return $query->simplePaginate ($length);
                }, function ($query) use ($length) {
                    return $query->paginate($length);
                });
        $data = new GamePriceResources($query);
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
     * @param GamePriceModel $gamePriceModel
     * @param  String_ $appids
     * @return GamePriceResources
     */
    public function show(GamePriceModel $gamePriceModel, $appids)
    {
        $array_appids = array_map('intval', explode(',', $appids));
        $query = $gamePriceModel->find($array_appids);
        $data = new GamePriceResources($query);
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
