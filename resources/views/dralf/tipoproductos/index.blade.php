{{-- PRODUCTO --}}

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
                <h3 class="title is-4 has-text-centered">Tipo Producto</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('tipoproductos.create') }}">Crear Tipo Producto</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-5 is-offset-4">
                @if ($tipoproductos != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Nombre</th>
                                <th class="has-text-left">Tipo de prueba</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($tipoproductos as $t)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $t->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $t->prueba }}
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('tipoproductos.destroy', ['tipoproductos' => $t->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('tipoproductos.edit', ['tipoproductos' => $t->id]) }}" title="Editar">Editar</a>
                                                        <button class="button is-danger is-small is-outlined confirmation" onclick="" title="Eliminar">Eliminar</button>
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
                                {!! $tipoproductos->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Tipo Productos</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
