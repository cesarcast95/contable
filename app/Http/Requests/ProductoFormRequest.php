<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductoFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Si va a modificar el producto no va a ser requerido cambiar el código
        // Si es una creación de un producto sí se requerirá

        if ($this->route('productos')) {
            return [
                'nombre'                => 'required|max:50',
                'cod'                   => 'required',
                'precio_utilidad'       => 'required',
                'porcentaje_ganancia'   => 'required',
                'categoria_id'          => 'required',
                'descuento'             => 'required',
                'promocion'             => 'required'
            
            ];
        } else {
            return [
                'nombre'                => 'required|max:50',
                'cod'                   => 'required',
                'precio_utilidad'       => 'required',
                'porcentaje_ganancia'   => 'required',
                'categoria_id'          => 'required',    
                'descuento'             => 'required',  
                'promocion'             => 'required'
            ];
        }


    }
}
