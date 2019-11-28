@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.productos._form', ['productos' => $productos, 'unidadmedidas' => $unidadmedidas])
@endsection

@section('javascripts')
    @parent
@endsection
