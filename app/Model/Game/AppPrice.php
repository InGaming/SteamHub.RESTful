<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class AppPrice extends Model
{
    protected $table = 'AppsPrices';
    public $timestamps = false;

    public function App()
    {
        return $this->belongsTo('App\Model\Game\App', 'AppID', 'AppID');
    }

    public function AppTag()
    {
        return $this->hasMany('App\Model\Game\AppTag','AppID', 'AppID');
    }
}
