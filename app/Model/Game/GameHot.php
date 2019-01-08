<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameHot extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function game_list()
    {
        return $this->belongsTo('App\Model\Game\GameList','appid', 'appid');
    }

    public function game_prices()
    {
        return $this->belongsToMany('App\Model\Game\GamePrice', 'game_lists', 'appid', 'appid');
    }

    public function game_tags()
    {
        return $this->belongsToMany('App\Model\Game\GameTag', 'game_lists', 'appid', 'appid');
    }

    public function game_reviews()
    {
        return $this->belongsToMany('App\Model\Game\GameReview', 'game_lists', 'appid', 'appid');
    }
}
