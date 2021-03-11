<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terceros extends Model
{
     
     protected $table = 'terceros';
     protected $fillable = ['nombre','celular', 'direccion','empresa_id'];
     public $timestamps = false;

 
}
