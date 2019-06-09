<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'siscell'], function () {
    Route::get('/', 'HomeController@index')->name('home'); // Rota para home do app
    Route::resource('/celulas', 'CelulasController');
    Route::get('/qtCelulas', 'CelulasController@getNumberCelulas');
    Route::get('qtParticipantes', 'PessoasController@qtPessoas');
});

Route::permanentRedirect('/', '/siscell');

Auth::routes();
