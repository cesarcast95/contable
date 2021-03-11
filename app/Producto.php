<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
    protected $table = 'productos';

	protected $fillable = ['nombre', 'cod', 'valor', 'empresa_id', 'precio_utilidad', 'ganancia_activada','porcentaje_ganancia','categoria_id','descripcion','descuento_activado','descuento','promocion_activada','promocion', 'impuesto'];
}
