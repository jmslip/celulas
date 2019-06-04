<?php

Route::group(['middleware' => ['auth'], 'prefix' => 'siscell'], function () {
    Route::get('/', 'HomeController@index')->name('home'); // Rota para home do app
    Route::get('/celulas', 'CelulasController@index')->name('celulas');
    Route::post('celulas/editar-celula/', 'CelulasController@editCelula')->name('celula_edit');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
