<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::domain(env('APP_API_URL'))->group(function () {
    // LIVEFEED CONTROLLER
    Route::get('/livefeed', 'API\LiveFeedController@index');
    // REGIONS CONTROLLER
    Route::get('/regions', 'API\RegionController');
    // CHAMPIONS CONTROLLER
    Route::get('/champions', 'API\ChampionController@index');
    Route::get('/champions/check', 'API\ChampionController@checkIfChampionExists');
});
