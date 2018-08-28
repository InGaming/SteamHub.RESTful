<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api->version('v2', function ($api) {
    $api->group(['middleware' => 'api.auth'], function ($api) {
        
    });

    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'api.throttle', 'limit' => 20, 'expires' => 1], function ($api) {
        $api->get('game/search/{model}/{method}/{action}/{param?}', 'Game\SearchController@index');
    });
});
