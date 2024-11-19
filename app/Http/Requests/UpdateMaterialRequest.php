<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
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
        //$material = $this->route('material');
        return [
            'nombre' => 'required|max:100|unique:materiales,nombre,'. $this->route('materiale')->id,
            'descripcion' => 'nullable|max:250',
            'unidad_medida' => 'nullable|max:100',
            'precio' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/'
        ];
    }
}
