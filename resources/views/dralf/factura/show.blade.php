@extends('dralf.layouts.base')

@section('title', 'Ver Factura')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.factura._show', [ 'factura' => $factura , 'detallefactura' => $detallefactura, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
