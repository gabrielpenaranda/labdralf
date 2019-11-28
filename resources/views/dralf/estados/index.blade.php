{{-- PRODUCTO --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3 class="d-flex justify-content-center">Estado</h3>
            </div>
            <div class="col-2 d-flex justify-content-md-center">
                <a class="btn btn-primary" href="{{ route('estados.create') }}">Crear Estado</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                @if ($estados != NULL)
                        <table class="table table-striped table-sm">
                            <thead>
                                <th scope="col">Nombre</th>
                                <th scope="col" class="d-flex justify-content-center">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($estados as $e)
                                    <tr>
                                        <td class="float-left">
                                            {{ $e->nombre }}
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::check())
                                                <form action="{{ route('estados.destroy', ['estados' => $e->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="btn-group mx-auto" role="group" aria-label="Basic example">
                                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('estados.edit', ['estados' => $e->id]) }}" title="Editar">Editar</a>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="" title="Eliminar">Eliminar</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    <div class="container">
                        <div class="row">
                            <div class="column is-6 is-offset-2">
                                {!! $estados->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Estados</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
