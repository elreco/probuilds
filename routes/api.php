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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api->version('v1', ['namespace' => 'App\Http\Controllers\API', 'middleware' => ['cors', 'api.throttle']], function ($api) {
    // LIVEFEED CONTROLLER
    $api->get('/livefeed', 'LiveFeedController@index');
    // MATCH CONTROLLER
    $api->get('/matchs', 'MatchController@show');
    // MATCH CONTROLLER
    $api->get('/summoners', 'SummonerController@show');
    // BUILD CONTROLLER
    $api->get('/build', 'BuildController@index');
    // REGIONS CONTROLLER
    $api->get('/regions', 'RegionController@index');
    // CHAMPIONS CONTROLLER
    $api->get('/champions', 'ChampionController@index');
    $api->get('/champions/check', 'ChampionController@checkIfChampionExists');
});
/* Route::domain(env('APP_API_URL'))->group(function () {
    // LIVEFEED CONTROLLER
    Route::get('/livefeed', 'LiveFeedController@index');
    // MATCH CONTROLLER
    Route::get('/match/show-details', 'MatchController@showDetails');
    // BUILD CONTROLLER
    Route::get('/build', 'BuildController@index');
    // REGIONS CONTROLLER
    Route::get('/regions', 'RegionController');
    // CHAMPIONS CONTROLLER
    Route::get('/champions', 'ChampionController@index');
    Route::get('/champions/check', 'ChampionController@checkIfChampionExists');
}); */
