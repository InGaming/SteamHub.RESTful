<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class AppTag extends Model
{
    protected $table = 'AppsTags';
    public $timestamps = false;

    public function App()
    {
        return $this->belongsTo('App\Model\Game\App', 'AppID', 'AppID');
    }
    
    public function reviews()
    {
        return $this->belongsTo('App\Model\Game\AppReview', 'AppID', 'AppID');
    }
}
