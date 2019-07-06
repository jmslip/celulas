@extends('layouts/principal')

@section('content')
    @include('/sidebar/ministracoes/ministracoes-grid')
    @include('layouts/grid')
    @include('/sidebar/ministracoes/ministracoes-form')
    @include('layouts/modal')
@stop