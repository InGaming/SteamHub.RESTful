<?php

namespace App\Http\Controllers\V2\News;

use Cache;
use Request;
use App\Http\Controllers\Controller;
use App\Model\News\News;

class NewsController extends Controller
{
    public function index()
    {
        return Cache::remember(Request::fullUrl(), 10, function () {
            if (Request::get('type')) return News::with(['NewsArticles'])->where('Type', Request::get('type'))->latest('LastUpdated')->paginate(Request::get('size'));
            else return News::with(['NewsArticles'])->latest('LastUpdated')->paginate(Request::get('size'));
        });
    }

    public function show($id)
    {
        return Cache::remember(Request::fullUrl(), 10, function () use ($id) {
            return News::with(['NewsArticles'])->where('Title', $id)->first();
        });
    }
}
