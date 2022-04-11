<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenciasGeneralesRequest extends FormRequest
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
    * Prepare the data for validation.
    *
    * @return void
    */
    protected function prepareForValidation()
    {
        //$req = request();
        //dd($req);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'dominio' => 'nullable|max:50|string',
                'val_minimo' => 'required|max:150|string',
                'val_maximo' => 'nullable|max:150|string',
                'descripcion' => 'required|max:250|string',
                'codigo' => 'nullable|max:150|string',
                'referencia' => 'nullable|max:150|string',
                'env_correo' => 'nullable|accepted',
                'dominio-combo' => 'nullable|max:50|string',
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
                'dominio' => 'Dominio',
                'val_minimo' => 'Valor mínimo',
                'val_maximo' => 'Valor máximo',
                'descripcion' => 'Descripción',
                'codigo' => 'Código',
                'referencia' => 'Referencia',
                'env_correo' => 'Envía correo',
                'dominio-combo' => 'Dominio',
        ];
    }
}
