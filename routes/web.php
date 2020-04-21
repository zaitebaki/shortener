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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('indexPage');
Route::post('/', 'IndexController@getShortLink')->name('getShortLink');
Route::get('/{token}', 'IndexController@redirect')->name('redirect');
Route::get('/{token}/statistic', 'StatisticController@getStatistic')->name('statistic');
