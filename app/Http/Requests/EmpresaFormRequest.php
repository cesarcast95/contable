<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmpresaFormRequest extends Request
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
            'nombre' => 'required|max:50',
            'tipo_empresa' => 'required',
            'nit' => 'required|max:12',
            'telefono' => 'required|min:7|numeric',
            'ciudad' => 'required',
            'direccion' => 'required|max:50',
            'actividad_economica' => 'required|max:100',
            'caja_mayor' => 'required|numeric',
            'caja_menor' => 'required|numeric',
            'banco' => 'required|max:50'
        ];
    }
}
