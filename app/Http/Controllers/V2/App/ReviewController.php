<?php

namespace App\Http\Controllers\V2\App;

use Cache;
use Request;
use App\Model\Game\AppReview;
use App\Http\Controllers\Controller;

class ReviewController extends Controller 
{
  public function index() {
    return Cache::remember(Request::fullUrl(), 0, function () {
        if (Request::get('math') === 'count') {
            return AppReview::count();
        }
    });
  }
}