<?php

namespace App\Http\Controllers\V2\App;

use Request;
use Cache;
use App\Model\Game\AppInfo;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function show($id) {
        $requestQuery = Request::query();
        if (array_key_exists('key', $requestQuery))
            $key = explode(",",$requestQuery['key']); 
        else
            $key = NULL;
        return Cache::remember(Request::fullUrl(), 360, function () use ($id, $key) {
            return $result = AppInfo::with('KeyName:ID,DisplayName,DisplayChineseName')->where('AppID', $id)->where(function($query) use ($key) {
                $key && $query->whereIn('Key', $key);
            })->get(['Key', 'Value']);
        });
    }
}
