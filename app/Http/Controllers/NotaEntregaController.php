<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateNotaEntregaRequest;
use App\Http\Requests\UpdateNotaEntregaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Cliente;
use App\Lote;

class NotaEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $modulo
     * @return \Illuminate\Http\Response
     */
    public function index($modulo)
    {
        $factura = Factura::where('nota_entrega_factura', '=', true)->orderBy('numero_factura', 'desc')->paginate(10);
        return view('dralf.notaentrega.index')->with(['factura' => $factura])->with(['modulo' => $modulo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $modulo
     * @return \Illuminate\Http\Response
     */
    public function create($modulo)
    {
        $factura = new Factura;
        $cliente = Cliente::orderBy('nombre_cliente', 'asc')->get();
        $lote = Lote::where('cantidad_disponible_lote', '>', 0)->orderBy('numero_lote', 'asc')->get();
        if (count($lote) == 0)
        {
            session()->flash('warning', 'Debe incluir un lote antes de incluir una nota de entrega');
            return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
        }
        else if (count($cliente) == 0)
        {
            session()->flash('warning', 'Debe incluir un cliente antes de incluir una nota de entrega');
            return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
        }
        return view('dralf.notaentrega.create')->with(['factura' => $factura])->with(['cliente' => $cliente])->with(['modulo' => $modulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $modulo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $modulo)
    {
        $fecha_factura = date('Y-m-d');
        $factura = new Factura;
        $factura->numero_factura = $request->get('numero_factura');
        $factura->fecha_factura = $fecha_factura;
        $factura->monto_factura = $request->get('monto_factura');
        $factura->saldo_factura = $request->get('monto_factura');
        $factura->nota_entrega_factura = true;
        $factura->iva_factura = 0;
        $factura->cliente_id = $request->get('cliente_id');
        $factura->user_id = auth()->user()->id;
        $factura->save();
        session()->flash('message', 'Nota de entrega creada con éxito!');
        return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $modulo
     * @param int  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura, $modulo)
    {
        $detallefactura = DetalleFactura::where('factura_id', $factura->id)->orderBy('lote_id', 'asc')->paginate(10);
        return view('dralf.notaentrega.show')->with(['factura' => $factura])->with(['detallefactura'=> $detallefactura])->with(['modulo' => $modulo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        $lote = Producto::all();
        return view('dralf.factura.edit')->with(['factura' => $factura])->with(['lote' => $lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        $fecha_factura = date("Y-m-d", strtotime($request->get('fecha_factura')));
        $factura->fecha_factura = $fecha_factura;
        $factura->monto_factura = $request->get('monto_factura');
        $factura->cliente_id = $request->get('cliente_id');
        $factura->user_id = auth()->user()->id;
        $factura->update();
        session()->flash('message', 'Factura actualizado!');
        return redirect()->route('notaentrega.index')->with(['modulo' => $modulo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        if (($factura->entregas->count() > 0) || ($factura->pagos->count() > 0))
        {
            session()->flash('error', 'No puede eliminar la nota de entrega, posee información relacionada');
            return redirect()->route('notaentrega.index')->with(['modulo' => $modulo]);
        }
        else
        {
            $factura->delete();
            session()->flash('message', 'Nota de entrega eliminada!');
            return redirect()->route('notaentrega.index')->with(['modulo' => $modulo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $factura
     * @return \Illuminate\Http\Response
     */
    public function detailIndex(Factura $factura)
    {
        $detalle = DetalleFactura::where('factura_id', $factura->id)->orderBy('lote_id', 'asc')->paginate(10);
        return view('dralf.detalleFactura.index')->with(['factura' => $factura])->with(['detalle' => $detalle])->with(['modulo' => $modulo]);
    }
}