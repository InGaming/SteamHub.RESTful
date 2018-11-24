<?php

namespace App\Model\Api\V3\Game;

use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
}
