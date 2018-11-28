<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
}
