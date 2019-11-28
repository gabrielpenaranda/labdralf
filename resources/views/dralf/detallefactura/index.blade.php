{{-- DETALLE FACTURA --}}
@extends('dralf.layouts.base')

@section('stylesheets')

@parent @endsection

@include('dralf.layouts._nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-8 text-center">
            <h4>
                @if ($modulo == 'factura') 
                {{ 'Registro de Items de Factura' }}
                @else
                {{ 'Registro de Items de Nota de Entrega' }}
                @endif
            </h4>
        </div>
        <div class="col-xs-2">
            @if ($modulo == 'factura')
            <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
            @else
            <a class="btn btn-danger" href="{{ route('notaentrega.index', ['modulo' => $modulo]) }}">Regresar</a>
            @endif
        </div>
    </div>
    <div class="row">
        @if ($factura != NULL)
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <table class="table">
                <thead>
                    <th class="text-left">Número</th>
                    <th class="text-left">Cliente</th>
                    <th class="text-left">Fecha</th>
                    <th class="text-left">Monto</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            {{ $factura->numero_factura }}
                        </td>
                        <td class="text-left">
                            {{ $factura->cliente->nombre_cliente }}
                        </td>
                        <td class="text-left">
                            @php
                            $fecha = date("d-m-Y", strtotime($factura->fecha_factura));
                            @endphp {{ $fecha }}
                        </td>
                        <td class="text-left">
                            {{ $factura->monto_factura }}
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('detailfacturas.create', ['factura' => $factura->id, 'modulo' => $modulo]) }}">Agregar Item</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            @if ($factura != NULL)
            <table class="table table-striped">
                <thead>
                    <th class="text-left">Producto</th>
                    <th class="text-left">Número Lote</th>
                    <th class="text-left">Cantidad</th>
                    {{-- <th class="text-left">Acciones</th> --}}
                </thead>
                <tbody>
                    @foreach ($detallefactura as $f)
                    <tr>
                        <td class="text-left">
                            {{ $f->lote->producto->nombre_producto }}
                        </td>
                        <td class="text-left">
                            {{ $f->lote->numero_lote }}
                        </td>
                       <td class="text-left">
                            {{ $f->cantidad_detalle_factura }}
                        </td>
                        {{-- <td class="text-center">
                            @if (Auth::check())
                            <form action="{{ route('detailfacturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-danger" title="Eliminar">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                                <a class="btn btn-info" href="{{ route('facturas.detailindex', ['factura' => $f->id]) }}" title="Agregar productos">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>
                                <a class="btn btn-warning" href="{{ route('facturas.show', ['factura' => $f->id]) }}" title="Ver factura">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>
                            </form>
                            @endif
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        {!! $detallefactura->render() !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascripts')

@parent @endsection