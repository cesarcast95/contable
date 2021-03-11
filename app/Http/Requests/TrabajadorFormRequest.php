<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TrabajadorFormRequest extends Request
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
            'telefono' => 'required|numeric|min:7',
            'direccion' => 'required|max:50',
            'cedula' => 'required|min:8'
        ];
    }
}
