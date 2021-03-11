<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'empresas';

	protected $fillable = ['ciudad', 'direccion', 'telefono', 'nit','nombre','tipo_regimen_id', 'actividad_economica', 'user_id', 'caja_menor','caja_mayor','banco', 'tipo_empresa'];
}
