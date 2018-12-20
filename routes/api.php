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

Route::group(['name' => 'api.', 'prefix' => 'v3', 'middleware' => 'api'], function () {
    Route::group(['name' => 'game.', 'prefix' => 'game', 'namespace' => 'Game'], function () {
        Route::apiResources([
            'list' => 'GameListController',
            'price' => 'GamePriceController'
        ]);
    });

    Route::group(['name' => 'dota.', 'prefix' => 'dota', 'namespace' => 'Dota'], function () {
        Route::group(['name' => 'zhushou.', 'prefix' => 'zhushou', 'namespace' => 'Zhushou'], function () {
            Route::group(['name' => 'log.', 'prefix' => 'log', 'namespace' => 'Log'], function () {
                Route::group(['name' => 'change.', 'prefix' => 'change', 'namespace' => 'Change'], function () {
                    Route::get('list', 'ListController@index');
                });
                Route::group(['name' => 'update.', 'prefix' => 'update', 'namespace' => 'Update'], function () {
                    Route::get('list', 'ListController@index');
                });
            });

            Route::group(['name' => 'dialog.', 'prefix' => 'dialog', 'namespace' => 'Dialog'], function () {
                Route::apiResources([
                    'list' => 'ListController',
                ]);
            });
        });
    });
});
