@extends('adminlte::page')
@push('css')
    <link rel="stylesheet" href="/css/celulas.css">
@endpush

@section('title', 'home')

@section('content_header')
    <h1>Sistema de Células <small>Igreja Resgatando Vidas</small></h1>
@stop

@section('content')
    @include('home/principal')
@stop
