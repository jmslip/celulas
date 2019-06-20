@extends('adminlte::page')

@section('content_header')
    <h1>Células Cadastradas</h1>
@stop

@section('content')
    @include('/sidebar/celulas/celulas-grid')
    @include('layouts/grid')
    @include('sidebar/celulas/celulas-form')
@stop
