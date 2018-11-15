<?php

namespace App\Model\Game;

use Illuminate\Database\Eloquent\Model;

class AppReview extends Model
{
    protected $table = 'AppsReviews';
    public $timestamps = false;

    public function tags()
    {
        return $this->hasMany('App\Model\Game\AppTag', 'AppID', 'AppID');
    }
}
