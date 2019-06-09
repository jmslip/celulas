<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'siscell'], function () {
    Route::get('/', 'HomeController@index')->name('home'); // Rota para home do app
    Route::resource('/celulas', 'CelulasController');
});

Route::permanentRedirect('/', '/siscell');

Auth::routes();
