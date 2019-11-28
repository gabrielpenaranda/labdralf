{{-- LOTE --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <br>
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                <h3 class="title is-4 has-text-centered">Lote</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('lotes.create') }}">Crear Lote</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($lotes != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Número Lote</th>
                                <th class="has-text-left">Producto</th>
                                <th class="has-text-left">Fecha prod.</th>
                                <th class="has-text-left">Fecha venc.</th>
                                <th class="has-text-left">Cant. prod.</th>
                                <th class="has-text-left">Cant. prueba</th>
                                <th class="has-text-left">Cant. disp.</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($lotes as $l)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->numero }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->productos->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->fecha_produccion }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->fecha_vencimiento }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->cantidad_producida }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->cantidad_prueba }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $l->cantidad_disponible }}
                                        </td>
                                        <td>
                                            @if (Auth::check())

                                                <form action="{{ route('lotes.destroy', ['lotes' => $l->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('lotes.edit', ['lotes' => $l->id]) }}" title="Editar">Editar</a>
                                                        <button class="button is-danger is-small is-outlined confirmation" title="Eliminar">Eliminar</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <div class="columns is-mobile">
                            <div class="column is-6 is-offset-2">
                                {!! $lotes->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Productos</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
