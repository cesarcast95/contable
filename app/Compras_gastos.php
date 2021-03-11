<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras_gastos extends Model
{
     protected $table = 'compras_gastos';

	protected $fillable = ['codigo', 'nombre', 'fecha', 'acomulado_haber','saldo','tipo_estado','empresa_id','cuenta','detalle','pago'];
}
