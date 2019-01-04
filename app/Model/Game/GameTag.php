<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameTag extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function game_list()
    {
        return $this->belongsTo('App\Model\Game\GameList','appid', 'appid');
    }
}
