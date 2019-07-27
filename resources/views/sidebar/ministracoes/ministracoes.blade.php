@extends('layouts/principal')

@section('content')
    @if ($grid == 'inativos')
        @include('/sidebar/ministracoes/ministracoes-inativas-grid')
    @elseif ($grid == 'lixeira')
        @include('/sidebar/ministracoes/ministracoes-trash-grid')
    @else 
        @include('/sidebar/ministracoes/ministracoes-grid')
    @endif
    @include('layouts/grid')
    @include('/sidebar/ministracoes/ministracoes-form')
    @include('layouts/modal')
@stop