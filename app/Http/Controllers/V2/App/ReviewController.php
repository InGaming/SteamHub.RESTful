<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\App;
use App\Model\Game\AppReview;
use App\Http\Controllers\Controller;

class ReviewController extends Controller 
{
  public function index() {
    return Cache::remember(Request::fullUrl(), 360, function () {
        if (Request::get('math') === 'count') {
            return AppReview::count();
        }
        if (Request::get('type') === 'top') {
          $appid = AppReview::where('ReviewTitle', '好评如潮')->distinct()->pluck('AppID');
           
          return App::with(['AppPrice', 'AppReview'])
              ->whereNotNull('ShortDescription')
              ->whereIn('AppID', $appid)->orderBy('LastUpdated', 'desc')
              ->paginate(Request::get('param'));
        }
    });
  }
}