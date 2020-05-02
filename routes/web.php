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
    Route::get('/{any}', 'ApplicationController')->where('any', '.*');
};
Route::group(['domain' => env('APP_WEB_URL')], $appRoutes);
Route::group(['domain' => env('APP_WEB_URL_LOCAL')], $appRoutes);
