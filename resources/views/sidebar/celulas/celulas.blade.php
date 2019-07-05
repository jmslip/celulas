@extends('layouts/principal')

@section('content')
    @include('/sidebar/celulas/celulas-grid')
    @include('layouts/grid')
    @include('sidebar/celulas/celulas-form')
    @include('layouts/modal')
@stop
