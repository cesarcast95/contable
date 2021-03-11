<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes_id extends Model
{
     protected $table = 'clientes_ids';
     protected $fillable = ['nombre','tel', 'direccion','cedula', 'empresa_id'];
     public $timestamps = false;
}
