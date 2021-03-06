<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GamePrice extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function getFinalAttribute($value)
    {
        return $value / 100;
    }

    public function getInitialAttribute($value)
    {
        return $value / 100;
    }

    public function game_list()
    {
        return $this->belongsTo('App\Model\Game\GameList','appid', 'appid');
    }
}
