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

Route::get('spectate/store', 'API\SpectateController@store');
Route::get('login/twitch', 'Auth\LoginController@redirectToProvider');
Route::get('login/twitch/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/{any}', 'ApplicationController')->where('any', '.*');
