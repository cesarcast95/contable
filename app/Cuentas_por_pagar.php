<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas_por_pagar extends Model
{
     protected $table = 'cuentas_por_pagar';

	protected $fillable = ['tercero', 'caja', 'valor','pagado', 'empresa_id','fecha'];
}
