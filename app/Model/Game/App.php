<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'Apps';
    public $timestamps = false;

    public function AppType()
    {
        return $this->hasOne('App\Model\Game\AppType', 'AppType', 'AppType');
    }

    public function AppPrice()
    {
        return $this->hasMany('App\Model\Game\AppPrice', 'AppID', 'AppID');
    }

    public function AppInfo()
    {
        return $this->hasMany('App\Model\Game\AppInfo', 'AppID', 'AppID');
    }
}
