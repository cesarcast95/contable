<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso_producto extends Model
{
    
    protected $table = 'ingreso_producto';
	protected $fillable = ['producto_id', 'cantidad', 'fecha_ingreso', 'empresa_id', 'tipo_ingreso', 'proveedor_id','caja'];
	public $timestamps = false;
}
