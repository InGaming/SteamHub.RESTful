<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class GameList extends Model
{
    protected $primaryKey = 'appid';
    protected $hidden = ['id'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
