<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateLoteRequest;
use App\Http\Requests\UpdateLoteRequest;
use App\Lote;
use App\Producto;
use App\Bitacora;

class LoteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lotes = Lote::orderBy('numero', 'desc')->paginate(7);
    return view('dralf.lotes.index')->with(['lotes' => $lotes]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lotes = new Lote;
    $productos = Producto::all();
    $titulo = 'Crear Lote';
    if (count($productos) == 0)
    {
      session()->flash('error', 'Debe incluir un producto antes de incluir un lote');
      return redirect()->route('lotes.index');
    }
    return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['titulo' => $titulo]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateLoteRequest $request)
  {
    $fecha_produccion = date("Y-m-d", strtotime($request->get('fecha_produccion')));
    $fecha_vencimiento = date("Y-m-d", strtotime($request->get('fecha_vencimiento')));
    $lotes = new Lote;
    $lotes->numero = strtoupper($request->get('numero'));
    $lotes->fecha_produccion = $fecha_produccion;
    $lotes->fecha_vencimiento = $fecha_vencimiento;
    $lotes->cantidad_producida = $request->get('cantidad_producida');
    $lotes->cantidad_prueba = $request->get('cantidad_prueba');
    $lotes->cantidad_disponible = $request->get('cantidad_producida') - $request->get('cantidad_prueba');
    $lotes->productos_id = $request->get('productos_id');
    $lotes->save();
    $bitacoras = new Bitacora;
    $bitacoras->descripcion = "Crear registro: ".$lotes->nombre;
    $bitacoras->accion = 'C';
    $bitacoras->tabla = 'lotes';
    $bitacoras->tabla_id = $lotes->id;
    $bitacoras->user_id = auth()->user()->id;
    $bitacoras->save();
    session()->flash('message', 'Lote creado con éxito!');
    return redirect()->route('lotes.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function show($lotes)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function edit(Lote $lotes)
  {
    //  if ($lotes->detallefacturas->count() > 0)
    // {
    //   session()->flash('warning', 'No puede modificar el lote, posee información relacionada');
    //   return redirect()->route('lotes.index');
    // }
    // else
    // {
    //   $productos = Producto::all();
    //   $titulo = 'Editar Lote';
    //   return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['titulo' => $titulo]);
    // }
    try {
        if ($lotes->detallefacturas->count() > 0)
        {
          session()->flash('warning', 'No puede modificar el lote, posee información relacionada');
          return redirect()->route('lotes.index');
        }
        else
        {
          $productos = Producto::all();
          $titulo = 'Editar Lote';
          return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['titulo' => $titulo]);
        }
    }
    catch (\Illuminate\Database\QueryException $e) {
        if($e->getCode() == "42S22") {
            $productos = Producto::all();
            $titulo = 'Editar Lote';
            return view('dralf.lotes.form')->with(['lotes' => $lotes])->with(['productos' => $productos])->with(['titulo' => $titulo]);
        }
    }

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateLoteRequest $request, Lote $lotes)
  {
    $fecha_produccion = date("Y-m-d", strtotime($request->get('fecha_produccion')));
    $fecha_vencimiento = date("Y-m-d", strtotime($request->get('fecha_vencimiento')));
    $lotes->fecha_produccion = $fecha_produccion;
    $lotes->fecha_vencimiento = $fecha_vencimiento;
    $lotes->cantidad_producida = $request->get('cantidad_producida');
    $lotes->cantidad_prueba = $request->get('cantidad_prueba');
    $lotes->cantidad_disponible = $request->get('cantidad_producida') - $request->get('cantidad_prueba');
    $bitacoras->accion = 'U';
    $lotes->productos_id = $request->get('productos_id');
    $bitacoras = new Bitacora;
    $bitacoras->descripcion = "Actualizar/Modificar registro: ".$lotes->nombre;
    $bitacoras->tabla = 'lotes';
    $bitacoras->tabla_id = $lotes->id;
    $bitacoras->user_id = auth()->user()->id;
    $lotes->update();
    session()->flash('message', 'Lote actualizado!');
    return redirect()->route('lotes.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $lotes
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lote $lotes)
  {
      try {
          $lotes->delete();
          $bitacoras = new Bitacora;
          $bitacoras->descripcion = "Eliminar registro: ".$lotes->nombre;
          $bitacoras->accion = 'D';
          $bitacoras->tabla = 'lotes';
          $bitacoras->tabla_id = $lotes->id;
          $bitacoras->user_id = auth()->user()->id;
          $bitacoras->save();
          session()->flash('message', 'Lote eliminado!');
          return redirect()->route('lotes.index');
      }
      catch (\Illuminate\Database\QueryException $e) {
          if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
              session()->flash('warning', 'No puede eliminar producto, posee información relacionada');
              return redirect()->route('lotes.index');
          }
      }
  }
}
