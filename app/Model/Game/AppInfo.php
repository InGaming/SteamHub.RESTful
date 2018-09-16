<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class AppInfo extends Model
{
    protected $table = 'AppsInfo';
    public $timestamps = false;

    public function App()
    {
        return $this->belongsTo('App\Model\Game\App', 'AppID', 'AppID');
    }

    public function AppPrice()
    {
        return $this->hasManyThrough('App\Model\Game\AppPrice', 'App\Model\Game\App', 'AppID', 'AppID', 'AppID', 'AppID');
    }

    public function KeyName()
    {
        return $this->hasOne('App\Model\Game\KeyName', 'ID', 'Key');
    }
}
