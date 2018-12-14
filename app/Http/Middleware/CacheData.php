<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class CacheData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->fullUrl();
        if (Cache::has($url)) {
            return Cache::get($url);
        }
        return $next($request);
    }

    /**
     * Handle an after request
     *
     * @param \Illuminate\Http\Request  $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        $url = $request->fullUrl();
        if (!is_null($response))
            Cache::add($url, $response, config('cache.expire'));
    }
}
