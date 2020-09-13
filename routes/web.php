<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainController@index')->name('main');
Route::get('/statistic/{link}', 'MainController@showInfoShortLink')->name('info');
Route::get('/stat/all', 'MainController@showStatisticAllLink')->name('statistic');
Route::get('/{link}', 'MainController@shortLinkRedirect')->name('redirect-link');
Route::post('/create-short-link', 'MainController@createShortLink')->name('create-short-link');
