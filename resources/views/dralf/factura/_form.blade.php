{{-- LOTE --}}
<div class="container">

    <div class="row">
        <div class="col-xs-7 col-md-offset-2 col-md-6">
            @if ($factura->exists)
                <h4>Edición de Factura</h4>
                <form action="{{ route('facturas.update', ['factura' => $factura->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4>Nueva Factura</h4>
                <form action="{{ route('facturas.store', ['modulo' => $modulo]) }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="numero_factura">Número de Factura:</label>
                @if (!$factura->exists)
                    <input type="text" name="numero_factura" class="form-control" value="{{ $factura->numero_factura or old('numero_factura')}}" />
                @else
                    <span>{{ $factura->numero_factura }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="cliente_id">Cliente: </label>
                <select name="cliente_id" class="form-control">
                    @foreach ($cliente as $c)
                        @if ($factura->cliente_id == $c->id)
                            <option value="{{ $c->id }}" selected>
                            @else
                                <option value="{{ $c->id }}">
                                @endif
                                {{ $c->nombre_cliente }} {{ $c->rif_cliente }}
                            </option>
                        @endforeach
                    </select>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="monto_factura">Monto Bs.:</label>
                <input type="number" step="0.01" min="0" name="monto_factura" class="form-control" value="{{ $factura->monto_factura or old('monto_factura')}}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="iva_factura">IVA Bs.:</label>
                <input type="number" step="0.01" min="0" name="iva_factura" class="form-control" value="{{ $factura->iva_factura or old('iva_factura')}}" />
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="ccol-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Grabar</button>
            </div>
        </div>
    </div>

    </form>
</div>
</div>
