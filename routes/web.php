<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//

$appRoutes = function () {
    Route::get('spectate/store', 'API\SpectateController@store');
    Route::get('login/twitch', 'Auth\LoginController@redirectToProvider');
    Route::get('login/twitch/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('/{any}', 'ApplicationController')->where('any', '.*');
    // auth 
};
Route::group(['domain' => env('APP_WEB_URL')], $appRoutes);
Route::group(['domain' => env('APP_WEB_URL_LOCAL')], $appRoutes);
