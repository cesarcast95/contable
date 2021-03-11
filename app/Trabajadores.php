<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
     
     protected $table = 'trabajadores';
     protected $fillable = ['nombre','telefono', 'direccion','cedula', 'empresa_id'];
     public $timestamps = false;

     public function pagos()
    {
        return $this->hasMany('App\Pagos');
        
    }

}
