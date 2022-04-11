<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSistemasRequest extends FormRequest
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
            'nombre' => 'max:255|string',
            'descripcion' => 'max:255|string',
            'proveedor' => 'required|integer|exists:proveedores,id',
            'estado' => 'required|boolean'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'proveedor' => 'Proveedor',
            'nombre'  => 'Nombre',
            'estado' => 'Estado',
        ];
    }
}
