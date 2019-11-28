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
                <h3 class="title is-4 has-text-centered">Ciudad</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('ciudades.create') }}">Crear Ciudad</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                @if ($ciudades != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Ciudad</th>
                                <th class="has-text-left">Estado</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($ciudades as $c)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->estados->nombre }}
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('ciudades.destroy', ['ciudades' => $c->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('ciudades.edit', ['ciudades' => $c->id]) }}" title="Editar">Editar</a>
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
                                {!! $ciudades->render() !!}
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Ciudades</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
