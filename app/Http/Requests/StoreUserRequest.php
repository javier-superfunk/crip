<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $reglas = [
            'name' => 'max:255|string',
            'email' => 'required|email',
            'tip_usuario' => 'required|max:1|string|in:I,P'
        ];

        // Si es proveedor
        if ($this->tip_usuario == 'P') {
            $reglas += ['proveedor' => 'required|integer|exists:proveedores,id',];
        }
        
        // Si es informante
        if ($this->tip_usuario == 'I') {
            $reglas += ['roles' => 'exists:roles,name',];
        }

        return $reglas;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Email',
            'name'  => 'Nombre',
            'tip_usuario' => 'Tipo de usuario',
            'proveedor' => 'Proveedor',
        ];
    }
}
