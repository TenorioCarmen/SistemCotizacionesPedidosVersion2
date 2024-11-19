<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
          'nombre' => 'required|unique:productos,nombre|max:100', 
           'descripcion' => 'nullable|max:255',
           'precio_unitario' => 'required|unique:productos|numeric',
           'talla' => 'nullable|max:45',
            'color' => 'nullable|max:45',
            'genero' => 'nullable|max:45',
            'costo_mano_obra' => 'nullable|numeric|unique:productos',
            'img_path' => 'nullable|image|mimes:png,jpg,jpeg|max:255',
           'categorias' => 'required|array'

        ];
    }

    public function attributes()
    {
        return [
            'precio_unitario' => 'precio',
            
        ];
    }
}
