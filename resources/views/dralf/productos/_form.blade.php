{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Producto</h3>
            @if ($productos->exists)
                <form action="{{ route('productos.update', ['productos' => $productos->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('productos.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('productos.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="codigo" class="is-size-7 has-text-weight-bold">Código:</label>
                    <input type="text" name="codigo" class="input is-small" value="{{ $productos->exists ? $productos->codigo : old('codigo') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombre:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $productos->exists ? $productos->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="capacidad" class="is-size-7 has-text-weight-bold">Capacidad:</label>
                    <input type="number" name="capacidad" class="input is-small" min=0 step=0.05 value="{{ $productos->exists ? $productos->capacidad : old('capacidad') }}" />
                </div>
            </div>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="unidadmedidas_id" class="is-size-7 has-text-weight-bold">Unidad de medida: </label>
                <div class="select">
                    <select name="unidadmedidas_id" class="is-size-7">
                        @foreach ($unidadmedidas as $u)
                            @if ($productos->unidadmedidas_id == $u->id)
                                <option value="{{ $u->id }}" selected>
                            @else
                                <option value="{{ $u->id }}">
                            @endif
                                {{ $u->unidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="tipoproductos_id" class="is-size-7 has-text-weight-bold">Tipo de producto: </label>
                <div class="select">
                    <select name="tipoproductos_id" class="is-size-7">
                        @foreach ($tipoproductos as $t)
                            @if ($productos->tipoproductos_id == $t->id)
                                <option value="{{ $t->id }}" selected>
                            @else
                                <option value="{{ $t->id }}">
                            @endif
                                {{ $t->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
