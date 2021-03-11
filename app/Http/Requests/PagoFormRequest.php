<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PagoFormRequest extends Request
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
            'valor' => 'required|numeric',
            'observacion' => 'max:500',
            'fecha' => 'required|date'
        ];
    }
}
