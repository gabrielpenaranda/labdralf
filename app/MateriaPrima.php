<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table = 'materiaprimas';

    protected $fillable = ['codigo', 'nombre', 'unidadmedidas_id'];

    public $timestamps = false;

    public function unidadmedidas()
    {
        return $this->belongsTo(UnidadMedida::class);
    }

}
