<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComprobanteFormRequest extends Request
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
            'tercero_id'   => 'required', 
            'valor'        => 'required', 
            'fecha'        => 'required', 
            'tipo_dato'    => 'required', 
            'codigo'       => 'required', 
        ];
    }
}
