<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Producto;
use App\UnidadMedida;
use App\Bitacora;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::orderBy('nombre', 'asc')->paginate(10);
        return view('dralf.productos.index')->with(['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = new Producto;
        $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->get();
        $titulo = 'Crear Producto';
        return view('dralf.productos.form')->with(['productos' => $productos, 'unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductoRequest $request)
    {
        $productos = new Producto;
        $productos->codigo = strtoupper($request->get('codigo'));
        $productos->nombre = strtoupper($request->get('nombre'));
        $productos->capacidad = strtoupper($request->get('capacidad'));
        $productos->unidadmedidas_id = $request->get('unidadmedidas_id');
        $productos->tipoproductos_id = $request->get('tipoproductos_id');
        $productos->save();
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Crear registro: ".$productos->nombre;
        $bitacoras->accion = 'C';
        $bitacoras->tabla = 'productos';
        $bitacoras->tabla_id = $productos->id;
        $bitacoras->user_id = auth()->user()->id;
        $bitacoras->save();
        session()->flash('message', 'Producto creado con éxito!');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function show($productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $productos)
    {
        $unidadmedidas = UnidadMedida::orderBy('unidad', 'asc')->get();
        $titulo = 'Editar Producto';
        return view('dralf.productos.form')->with(['productos' => $productos, 'unidadmedidas' => $unidadmedidas, 'titulo' => $titulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $productos)
    {
        $productos->codigo = strtoupper($request->get('codigo'));
        $productos->nombre = strtoupper($request->get('nombre'));
        $productos->capacidad = strtoupper($request->get('capacidad'));
        $productos->unidadmedidas_id = $request->get('unidadmedidas_id');
        $productos->tipoproductos_id = $request->get('tipoproductos_id');
        $bitacoras = new Bitacora;
        $bitacoras->descripcion = "Actualizar/Modificar registro: ".$productos->nombre;
        $bitacoras->accion = 'U';
        $bitacoras->tabla = 'productos';
        $bitacoras->tabla_id = $productos->id;
        $bitacoras->user_id = auth()->user()->id;
        $productos->update();
        $bitacoras->save();
        session()->flash('message', 'Producto actualizado!');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $productos)
    {
        try {
            $productos->delete();
            $bitacoras = new Bitacora;
            $bitacoras->descripcion = "Eliminar registro: ".$productos->nombre;
            $bitacoras->accion = 'D';
            $bitacoras->tabla = 'productos';
            $bitacoras->tabla_id = $productos->id;
            $bitacoras->user_id = auth()->user()->id;
            $bitacoras->save();
            session()->flash('message', 'Producto eliminado!');
            return redirect()->route('productos.index');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No puede eliminar producto, posee información relacionada');
                return redirect()->route('productos.index');
            }
        }
    }
}
