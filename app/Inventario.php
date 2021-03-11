<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    
    protected $table = 'inventario';

	protected $fillable = ['codigo', 'producto_id', 'existencia', 'minimo','maximo','almacen','bodega','empresa_id'];
	 public $timestamps = false;
}
