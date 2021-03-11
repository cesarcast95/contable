<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    
    protected $table = 'comprobante';
	protected $fillable = ['tercero_id','valor','detalle','fecha','tipo_dato','empresa_id', 'codigo','caja'];
	public $timestamps = false;
}
