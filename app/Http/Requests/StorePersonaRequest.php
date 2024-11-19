<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'razon_social'=> 'required|max:100',
            'ciudad'=> 'required|max:55',
            'calle'=> 'required|max:55',
            'nro_vivienda'=> 'required|max:20',
            'telefono'=> 'required|max:20|unique:personas,telefono',
            'email'=> 'nullable|email|max:100|unique:personas,email',
            'tipo_persona'=>'required|string|max:20'
        ];
    }
}
