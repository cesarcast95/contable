<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobros extends Model
{
     protected $table = 'cobros';

	protected $fillable = ['tercero', 'libramiento', 'vencimiento','pagado', 'empresa_id','caja'];
}
