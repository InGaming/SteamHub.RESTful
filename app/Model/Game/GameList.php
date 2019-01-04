<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function game_prices()
    {
        return $this->hasMany('App\Model\Game\GamePrice', 'appid', 'appid');
    }

    public function game_tags()
    {
        return $this->hasMany('App\Model\Game\GameTag', 'appid', 'appid');
    }

    public function game_reviews()
    {
        return $this->hasMany('App\Model\Game\GameReview', 'appid', 'appid');
    }
}
