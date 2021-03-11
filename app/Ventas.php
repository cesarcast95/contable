<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

	protected $fillable = ['codigo', 'tipo_transaccion_id', 'tipo_estado_id','fecha_elaboracion','cantidad','dinero','nombre','cliente_id','producto_id','total', 'empresa_id','sub_total','caja_tipo', 'activo', 'cajero', 'cod_tarjeta', 'consecutivo'];
}
