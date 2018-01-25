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

Route::get('/', 'HomeController@index');
Route::get('/home/index', ['uses' => 'HomeController@index', 'as' => 'home.index']);
Route::get('/curate/{astro_id}', ['uses' => 'HomeController@curate', 'as' => 'curate']);
Route::get('/getRankings', ['uses' => 'GetElmController@getRankings', 'as' => 'getRankings']);
