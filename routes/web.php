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

Route::group(['midleware' => ['auth'], 'prefix' => 'siscell'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('celulas', 'CelulasController@index')->name('celulas');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
