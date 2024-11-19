<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
        $cliente = $this->route('cliente');

        return [
            'razon_social'=> 'required|max:100',
            'ciudad'=> 'required|max:55',
            'calle'=> 'required|max:55',
            'nro_vivienda'=> 'required|max:20',
            'telefono'=> 'required|max:20',
            'email'=> 'nullable|email|max:100',
            'tipo_persona'=>'string|max:20'
        ];
    }
}
