<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'News';
    public $timestamps = false;

    public function NewsArticles()
    {
        return $this->hasOne('App\Model\News\NewsArticles', 'Title', 'Title');
    }
}
