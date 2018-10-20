<?php

namespace App\Http\Controllers\V2\News;

use Cache;
use Request;
use App\Http\Controllers\Controller;
use App\Model\News\News;

class NewsController extends Controller
{
    public function index ()
    {
        return Cache::remember(Request::fullUrl(), 2, function () {
            return News::latest('LastUpdated')->paginate(Request::get('size'));
        });
    }
}
