<?php

namespace App\Http\Controllers\Api\V3\Game;

use App\Http\Controllers\{
    Controller
};
use App\Http\Resources\Api\V3\Game\{
    GameList as GameListResources
};
use App\Model\Api\V3\Game\{
    GameList as GameListModel
};
use App\Http\Requests\Api\V3\Game\{
    GameListQuery
};
use Illuminate\Http\{
    Request
};
use phpDocumentor\Reflection\Types\{Array_, Boolean, Integer, String_};

class GameListController extends Controller
{
    /**
     * Define field when query $request->q.
     *
     * @var Array_ $text_field
     */
    protected $text_field = ['name', 'chinese_name', 'detailed_description', 'short_description'];

    /**
     * Display a listing of the resource.
     *
     * @param GameListQuery $request
     * @param GameListModel $gameListModel
     * @return GameListResources
     */
    public function index(GameListQuery $request, GameListModel $gameListModel)
    {
        /**
         * Define query param
         * View validation: app/Http/Requests/Api/V3/Game/GameListQuery.php
         *
         * @var String_ $q
         * @var Boolean $free
         * @var Integer $metacritic_score
         * @var Integer $steam_user_score
         * @var String_ $platforms
         * @var Integer $length
         * @var Boolean $simple_paginate
         * @var String_ $order
         * @var String_ $order_field
         */

        $q = $request->q;
        $free = $request->free;
        $metacritic_score = $request->metacritic_score;
        $steam_user_score = $request->steam_user_score;
        $platform = $request->platform;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;
        $text_field = $this->text_field;

        $query =
            $gameListModel->when(!is_null($free), function ($query) use ($free) {
                return $query->whereFree($free);
            })
                ->when($q, function ($query) use ($q, $text_field) {
                    return $query->where(function ($query) use ($q, $text_field) {
                        foreach ($text_field as $item) {
                            $query->orWhere($item, 'like', '%'.$q.'%');
                        }
                    });
                })
                ->when($metacritic_score, function ($query) use ($metacritic_score) {
                    return $query->whereMetacriticScore($metacritic_score);
                })
                ->when($steam_user_score, function ($query) use ($steam_user_score) {
                    return $query->whereSteamUserScore($steam_user_score);
                })
                ->when($platform, function ($query) use ($platform) {
                    return $query->where('platforms', 'like', '%'.$platform.'%');
                })
                ->when($order_field && $order, function ($query) use ($order_field, $order) {
                    return $query->orderBy($order_field, $order);
                })
                ->when($simple_paginate, function ($query) use ($length) {
                    return $query->simplePaginate ($length);
                }, function ($query) use ($length) {
                    return $query->paginate($length);
                });

        $data = new GameListResources($query);

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
     * @param GameListModel $gameListModel
     * @param int $appid
     * @return GameListResources
     */
    public function show(GameListModel $gameListModel, $appid)
    {
        $appids = array_map('intval', explode(',', $appid));
        $query = $gameListModel->find($appids);
        $data = new GameListResources($query);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $appid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $appid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $appid
     * @return \Illuminate\Http\Response
     */
    public function destroy($appid)
    {
        //
    }
}
