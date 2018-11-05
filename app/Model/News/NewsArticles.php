<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;

class NewsArticles extends Model
{
    protected $table = 'NewsArticles';
    public $timestamps = false;

    public function News()
    {
        return $this->belongsTo('App\Model\News\News', 'Title', 'Title');
    }
}
