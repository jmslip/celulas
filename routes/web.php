<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'siscell'], function () {
    // Rota home
    Route::get('/', 'HomeController@index')->name('home');
    //Rotas para Celulas
    Route::resource('/celulas', 'CelulasController');
    Route::get('/qtCelulas', 'CelulasController@getNumberCelulas');
    //Rotas para pessoas
    Route::get('/lideres', 'PessoasController@getLideresAtivos');
    Route::resource('/membros', 'PessoasController');
    Route::get('qtMembros', 'PessoasController@getQuantidadeMembros');
});

Route::permanentRedirect('/', '/siscell');

Auth::routes();
