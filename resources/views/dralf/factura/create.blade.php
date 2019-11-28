@extends('dralf.layouts.base')

@section('title', 'Crear Factura')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.factura._form', [ 'factura' => $factura , 'cliente' => $cliente, 'modulo' => $modulo ])
@endsection

@section('javascripts')
    @parent
@endsection
