{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Tipo Producto</h3>
            @if ($tipoproductos->exists)
                <form action="{{ route('tipoproductos.update', ['tipoproductos' => $tipoproductos->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('tipoproductos.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('tipoproductos.index') }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Tipo producto:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $tipoproductos->exists ? $tipoproductos->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="prueba" class="is-size-7 has-text-weight-bold">Tipo de prueba: </label>
                <div class="select">
                    <select name="prueba" class="is-size-7">
                        <option value="NO" selected>NO REQUIERE</option>
                        <option value="ANTICOAGULANTE">ANTICOAGULANTE</option>
                        {{-- <option value="Detergente">Detergente</option> --}}
                        <option value="DILUENTE">DILUENTE</option>
                        {{-- <option value="Limpiador">Limpiador</option> --}}
                        <option value="LISANTE">LISANTE</option>
                        <option value="RINSE">RINSE</option>
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
