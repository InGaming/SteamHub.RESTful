<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameList as GameListResources;
use App\Model\Game\GameList as GameListModel;
use App\Http\Requests\Game\GameListQuery;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\{Array_, String_};

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
         */
        
        $q = $request->q;
        $appids = $request->appids;
        $free = $request->free;
        $age = $request->age;
        $type = $request->type;
        $metacritic_review_score = $request->metacritic_review_score;
        $metacritic_review_link = $request->metacritic_review_link;
        $steam_user_review_score = $request->steam_user_review_score;
        $steam_user_review_count = $request->steam_user_review_count;
        $steam_user_review_summary = $request->steam_user_review_summary;
        $language = $request->language;
        $platform = $request->platform;
        $developer = $request->developer;
        $publisher = $request->publisher;
        $length = $request->length;
        $order = $request->order;
        $order_field = $request->order_field;
        $simple_paginate = $request->simple_paginate;
        $text_field = $this->text_field;

        $query =
            $gameListModel
                ->when($q, function ($query) use ($q, $text_field) {
                    return $query->where(function ($query) use ($q, $text_field) {
                        foreach ($text_field as $item) {
                            $query->orWhere($item, 'like', '%'.$q.'%');
                        }
                    });
                })
                ->when($appids, function ($query) use ($appids) {
                    $array_appids = array_map('intval', explode(',', $appids));
                    return $query->whereIn('appid', $array_appids);
                })
                ->when(!is_null($free), function ($query) use ($free) {
                    return $query->whereFree($free);
                })
                ->when(!is_null($age), function ($query) use ($age) {
                    return $query->whereAge($age);
                })
                ->when($type, function ($query) use ($type) {
                    return $query->whereType($type);
                })
                ->when($metacritic_review_score, function ($query) use ($metacritic_review_score) {
                    return $query->whereMetacriticReviewScore($metacritic_review_score);
                })
                ->when($metacritic_review_link, function ($query) use ($metacritic_review_link) {
                    return $query->whereMetacriticReviewLink($metacritic_review_link);
                })
                ->when($steam_user_review_score, function ($query) use ($steam_user_review_score) {
                    return $query->whereSteamUserReviewScore($steam_user_review_score);
                })
                ->when($steam_user_review_count, function ($query) use ($steam_user_review_count) {
                    return $query->whereSteamUserReviewCount($steam_user_review_count);
                })
                ->when($steam_user_review_summary, function ($query) use ($steam_user_review_summary) {
                    return $query->whereSteamUserReviewSummary($steam_user_review_summary);
                })
                ->when($language, function ($query) use ($language) {
                    return $query->where('languages', 'like', '%'.$language.'%');
                })
                ->when($platform, function ($query) use ($platform) {
                    return $query->where('platforms', 'like', '%'.$platform.'%');
                })
                ->when($developer, function ($query) use ($developer) {
                    return $query->where('developers', 'like', '%'.$developer.'%');
                })
                ->when($publisher, function ($query) use ($publisher) {
                    return $query->where('publishers', 'like', '%'.$publisher.'%');
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
     * @param String_ $appids
     * @return GameListResources
     */
    public function show(GameListModel $gameListModel, $appids)
    {
        $array_appids = array_map('intval', explode(',', $appids));
        $query = $gameListModel->find($array_appids);
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
