<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IngresoProductoFormRequest extends Request
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
        return [
            'producto_id'   => 'required', 
            'caja'          => 'required', 
            'cantidad'      => 'required|numeric', 
            'fecha_ingreso' => 'required', 
            'tipo_ingreso'  => 'required',
            'proveedor_id'  => 'required'
        ];
    }
}
