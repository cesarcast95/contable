<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
     protected $table = 'pagos';

	protected $fillable = ['movimiento','trabajador_id','cuenta','fecha', 'observacion', 'valor', 'empresa_id'];

	public function trabajadores()
    {
        return $this->belongsTo('App\Trabajadores');
    }
}
