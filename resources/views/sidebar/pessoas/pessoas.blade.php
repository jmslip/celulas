@extends('adminlte::page')

@section('content_header')
    <h1>Membros Cadastrados</h1>
@stop

@section('content')
    @include('sidebar/pessoas/pessoas-grid')
    @include('layouts/grid')
    @include('sidebar/pessoas/pessoas-form')
    @include('layouts/modal')
@stop
