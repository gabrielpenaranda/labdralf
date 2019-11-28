<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateEntregaRequest;
use App\Http\Requests\UpdateEntregaRequest;
use App\Factura;
use App\Entrega;
use App\DetalleFactura;
use App\DetalleEntrega;

class EntregaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function menu()
{
  return view('dralf.entrega.menu');
}

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
  $factura = Factura::orderBy('numero_factura', 'desc')->orderBy('fecha_factura', 'desc')->paginate(10);
  return view('dralf.entrega.index')->with(['factura' => $factura]);
}

/**
* Show the form for creating a new resource.
*
* @param string $modulo
* @param int $factura
* @return \Illuminate\Http\Response
*/
public function create(Factura $factura, $modulo)
{
  $entrega = new Entrega;
  return view('dralf.entrega.create')->with(['factura' => $factura])->with(['entrega' => $entrega])->with(['modulo' => $modulo]);
}

/**
* Store a newly created resource in storage.
*
* @param string $modulo
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(CreateEntregaRequest $request, $modulo)
{
  $fentrega = date("Y-m-d", strtotime($request->get('fecha_entrega')));
  if ($fentrega < $request->get('ffactura')) {
    session()->flash('error', 'Fecha de entrega no puede ser menor a fecha factura. Entrega no registrada');
    if ($modulo == 'factura') {
      return redirect()->route('facturas.index', ['modulo' => $modulo]);
    } else {
      return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
    }
  }
  $entrega = new Entrega;
  $entrega->numero_entrega = $request->get('numero_entrega');
  $entrega->fecha_entrega = $fentrega;
  $entrega->factura_id = $request->get('factura_id');
  $entrega->user_id = auth()->user()->id;
  $entrega->save();
  session()->flash('message', 'Entrega registrada satisfactoriamente');
  if ($modulo == 'factura') {
    return redirect()->route('facturas.index', ['modulo' => $modulo]);
  } else {
    return redirect()->route('notaentrega.index', ['modulo' => $modulo]);
  }
}

/**
* Display the specified resource.
*
* @return \Illuminate\Http\Response
*/
public function show_delivery()
{
  $factura = Factura::orderBy('numero_factura', 'desc')->orderBy('fecha_factura', 'desc')->paginate(10);
  return view('dralf.entrega.show')->with(['factura' => $factura]);
}

/**
* Display the specified resource.
*
* @param string $modulo
* @param int $factura
* @return \Illuminate\Http\Response
*/
public function show_delivery_detail(Factura $factura, $modulo)
{
  $detalle_factura = DetalleFactura::where('factura_id', $factura->id)->get();
  $detalle = DB::table('detalle_entregas')
  ->join('entregas', 'entregas.id', '=', 'detalle_entregas.entrega_id')
  ->join('facturas', 'facturas.id', '=', 'entregas.factura_id')
  ->join('detalle_facturas', 'detalle_facturas.id', '=', 'detalle_entregas.detallefactura_id')
  ->join('lotes', 'lotes.id', '=', 'detalle_facturas.lote_id')
  ->join('productos', 'productos.id', '=', 'lotes.producto_id')
  ->where('entregas.factura_id', '=', $factura->id)
  ->select('entregas.numero_entrega', 'entregas.fecha_entrega', 'detalle_entregas.cantidad_detalle_entrega', 'productos.nombre_producto')
  ->orderBy('fecha_entrega', 'asc')
  ->orderBy('numero_entrega', 'asc')
  ->get();
// dd($detalle);
// foreach($detalle as $de)
// {
//     echo $de->fecha_entrega;
// }
// return view('dralf.entrega.showdetail')->with('detalle', $detalle)->with(['factura' => $factura]);
  return view('dralf.entrega.showdetail', ['detalle_factura' => $detalle_factura, 'detalle' => $detalle, 'factura' => $factura, 'modulo' => $modulo]);
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
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
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

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function delivery()
{
// $detallefactura = DetalleFactura::where('factura_id', $factura->id)->where('resto_detalle_factura', '>', 0)->orderBy('lote_id', 'asc')->paginate(10);
  $factura = Factura::orderBy('numero_factura', 'desc')->orderBy('fecha_factura', 'desc')->paginate(10);
  return view('dralf.entrega.delivery')->with(['factura' => $factura]);
}

/**
* Display a listing of the resource.
*
* @param string $modulo
* @param int @factura
* @return \Illuminate\Http\Response
*/
public function selectdelivery(Factura $factura, $modulo)
{
// $detallefactura = DetalleFactura::where('factura_id', $factura->id)->where('resto_detalle_factura', '>', 0)->orderBy('lote_id', 'asc')->paginate(10);
  $entrega = Entrega::where('factura_id', $factura->id)->orderBy('numero_entrega', 'asc')->paginate(10);
  return view('dralf.entrega.selectdelivery')->with(['factura' => $factura])->with(['entrega' => $entrega])->with(['modulo' => $modulo]);
}

/**
* Display a listing of the resource.
*
* @param string $modulo
* @param int @entrega
* @return \Illuminate\Http\Response
*/
public function createdelivery(Entrega $entrega, $modulo)
{
  $detallefactura = DetalleFactura::where('factura_id', $entrega->factura_id)->where('resto_detalle_factura', '>', 0)->orderBy('lote_id', 'asc')->get();

// $entrega = Entrega::where('factura_id', $factura->id)->orderBy('numero_entrega', 'asc')->paginate(10);
  return view('dralf.entrega.createdelivery')->with(['entrega' => $entrega])->with(['detallefactura' => $detallefactura])->with(['modulo' => $modulo]);
}

/**
* Store a newly created resource in storage.
*
* @param string $modulo
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function storedelivery(Request $request, $modulo)
{
  $detallefactura_id = $request->get('detallefactura_id');
  $detallefactura = DetalleFactura::where('id', $detallefactura_id)->first();
  // dd($detallefactura);
  $resto = $detallefactura->resto_detalle_factura;
  $cantidad = $request->get('cantidad_detalle_entrega');
  if ($resto < $cantidad) {
    session()->flash('error', 'La cantidad a entregar no puede ser mayor a la facturada. Entrega no registrada!!!');
    if ($modulo == 'factura') {
      return redirect()->route('facturas.index', ['modulo', $modulo]);
    } else {
      return redirect()->route('notaentrega.index', ['modulo', $modulo]);
    }
  } 
  elseif ($cantidad <= 0)
  {
    session()->flash('error', 'Cantidad invalida. Entrega no registrada!!!');
    if ($modulo == 'factura') {
      return redirect()->route('facturas.index', ['modulo', $modulo]);
    }
    else
    {
      return redirect()->route('notaentrega.index', ['modulo', $modulo]);
    }
  }
  $detalleentrega = new DetalleEntrega;
  $detalleentrega->cantidad_detalle_entrega = $cantidad;
  $detalleentrega->entrega_id = $request->get('entrega_id');
  $detalleentrega->detallefactura_id = $detallefactura_id;
  $detalleentrega->user_id = auth()->user()->id;
  $detalleentrega->save();
  $detallefactura->resto_detalle_factura -= $cantidad;
  $detallefactura->update();
  session()->flash('message', 'Entrega registrada satisfactoriamente!!!');
  if ($modulo == 'factura') {
    return redirect()->route('facturas.index', ['modulo', $modulo]);
  }
  else
  {
    return redirect()->route('notaentrega.index', ['modulo', $modulo]);
  }
}
}
