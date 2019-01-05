<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameReview as GameReviewResources;
use App\Http\Requests\Game\GameReviewQuery;
use App\Model\Game\GameReview as GameTagModel;

class GameReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GameReviewQuery $request
     * @param GameTagModel $gameTagModel
     * @return GameReviewResources
     */
    public function index(GameReviewQuery $request, GameTagModel $gameTagModel)
    {
        $appids = $request->appids;
        $score = $request->score;
        $count = $request->count;
        $summary = $request->summary;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;

        $query =
            $gameTagModel
                ->with(['game_list'])
                ->when($appids, function ($query) use ($appids) {
                    $array_appids = array_map('intval', explode(',', $appids));
                    return $query->whereIn('appid', $array_appids);
                })
                ->when($score, function ($query) use ($score) {
                    $array_score = array_map('intval', explode(',', $score));
                    return $query->whereBetween('score', [$array_score[0], $array_score[1]]);
                })
                ->when($count, function ($query) use ($count) {
                    $array_count = array_map('intval', explode(',', $count));
                    return $query->whereBetween('count', [$array_count[0], $array_count[1]]);
                })
                ->when($summary, function ($query) use ($summary) {
                    return $query->where('summary', $summary);
                })
                ->when($order_field && $order, function ($query) use ($order_field, $order) {
                    return $query->orderBy($order_field, $order);
                })
                ->when($simple_paginate, function ($query) use ($length) {
                    return $query->simplePaginate($length);
                }, function ($query) use ($length) {
                    return $query->paginate($length);
                });
        return new GameReviewResources($query);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
