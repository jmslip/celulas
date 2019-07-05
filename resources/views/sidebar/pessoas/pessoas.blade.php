@extends('layouts/principal')

@section('content')
    @include('sidebar/pessoas/pessoas-grid')
    @include('layouts/grid')
    @include('sidebar/pessoas/pessoas-form')
    @include('layouts/modal')
@stop
