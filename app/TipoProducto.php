<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipoproductos';

    protected $fillable = ['nombre', 'prueba'];

    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
