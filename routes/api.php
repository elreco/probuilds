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
// middleware 'api.auth'
$api->version('v1', ['namespace' => 'App\Http\Controllers\API'], function ($api) {

    $api->group(['middleware' => ['api.auth']], function ($api) {
        // USER CONTROLLER
        $api->get('/user', 'Auth\UserController@current');
    });
    // SPECTATE CONTROLLER
    $api->get('/spectate', 'SpectateController@index');
    // LIVEFEED CONTROLLER
    $api->get('/livefeed', 'LiveFeedController@index');
    // MATCH CONTROLLER
    $api->get('/matches/{id}', 'MatchController@show');
    $api->get('/matches/{id}/items-timeline/{summonerId}', 'MatchController@itemsTimeline');
    $api->get('/matches/{id}/spells/{summonerId}', 'MatchController@spells');
    // SUMMONER CONTROLLER
    $api->get('/summoners/{id}', 'SummonerController@show');

    // REGIONS CONTROLLER
    $api->get('/regions', 'RegionController@index');
    // CHAMPIONS CONTROLLER
    $api->get('/champions', 'ChampionController@index');
    $api->get('/champions/{name}', 'ChampionController@show');
    $api->get('/champions-check', 'ChampionController@checkIfChampionExists');
    // SPELLS CONTROLLER
    /*
    $api->get('/champions/{name}', 'ChampionController@show'); */
});
