<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'siscell'], function () {
    // Rota home
    Route::get('/', 'HomeController@index')->name('home');
    //Rotas para Celulas
    Route::resource('/celulas', 'CelulasController');
    Route::get('/qtCelulas', 'CelulasController@getNumberCelulas');
    //Rotas para pessoas
    Route::get('/lideres', 'PessoasController@getLideresCelulasAtivos');
    Route::resource('/membros', 'PessoasController');
    Route::get('qtMembros', 'PessoasController@getQuantidadeMembros');
    //Rotas para ministrações
    Route::resource('/ministracoes', 'MinistracoesController');
    Route::get('/ministracoes-nao-publicadas/{url?}', 'MinistracoesController@index');

    //Rotas para Files
    Route::get('/download/{tipo}/{file}', 'FilesController@downloadFile');
});

Route::permanentRedirect('/', '/siscell');
Route::permanentRedirect('/home', '/siscell');

Auth::routes();
