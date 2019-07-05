@extends('adminlte::page')
@push('css')
    <link rel="stylesheet" href="/css/celulas.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script type="text/javascript" src="/js/celulas.js"></script>
@endpush

@section('content_header')
    <h1>{{ $title }}</h1>
@stop