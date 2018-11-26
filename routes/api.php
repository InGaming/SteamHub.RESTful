<?php

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

Route::group(['name' => 'api.', 'prefix' => 'v3', 'namespace' => 'Api\V3', 'middleware' => 'api'], function () {
    Route::group(['name' => 'game.', 'prefix' => 'game', 'namespace' => 'Game'], function () {
       Route::apiResource('/list', 'GameListController');
    });
});
