<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateDetalleFacturaRequest;
use App\Http\Requests\UpdateDetalleFacturaRequest;
use App\Factura;
use App\DetalleFactura;
use App\Lote;
use Laracasts\Flash;

class DetailFacturaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param string $modulo
   * @param  int  $factura
   * @return \Illuminate\Http\Response
   */
  public function index(Factura $factura, $modulo)
  {
    $detallefactura = DetalleFactura::where('factura_id', $factura->id)->orderBy('lote_id', 'asc')->paginate(10);
    return view('dralf.detallefactura.index')->with(['factura' => $factura])->with(['detallefactura' => $detallefactura])->with(['modulo' => $modulo]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param string $modulo
   * @param  int  $factura
   * @return \Illuminate\Http\Response
   */
  public function create(Factura $factura, $modulo)
  {
    $detallefactura = new DetalleFactura;
    $lote = Lote::where('cantidad_disponible_lote', '>', '0')->orderBy('fecha_produccion_lote', 'asc')->get();
    // dd($lote);
    return view('dralf.detallefactura.create')->with(['lote' => $lote])->with(['factura' => $factura])->with(['detallefactura' => $detallefactura])->with(['modulo' => $modulo]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param string $modulo
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateDetalleFacturaRequest $request, $modulo)
  {
    $lote = Lote::where('id', $request->get('lote_id'))->first();
    echo $lote->id;
    // dd($lote);

    if ($request->get('cantidad_detalle_factura') > $lote->cantidad_disponible_lote) {
      session()->flash('error', 'Cantidad es mayor a la disponible')->error()->important();
      if ($modulo == 'factura') {
        return redirect()->route('facturas.index', ['modulo' => $modulo]);
      } else {
        return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
      }
    } else {
      $lote->cantidad_disponible_lote -= $request->get('cantidad_detalle_factura');
      $lote->update();
    }
    $detallefactura = new DetalleFactura;
    $detallefactura->cantidad_detalle_factura = $request->get('cantidad_detalle_factura');
    $detallefactura->resto_detalle_factura = $request->get('cantidad_detalle_factura');
    $detallefactura->lote_id = $request->get('lote_id');
    $detallefactura->factura_id = $request->get('factura_id');
    $detallefactura->user_id = auth()->user()->id;
    $detallefactura->save();
    session()->flash('message', 'Item de factura creado con éxito!');
    if ($modulo == 'factura') {
      return redirect()->route('facturas.index', ['modulo' => $modulo]);
    }
    else
    {
      return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param string $modulo
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $modulo)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
