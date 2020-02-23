<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserValidationFormRequest extends FormRequest
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
            'nombre' => 'required|min:5',
            'apellidos' => 'required|min:5',
            'edad' => 'required',
            'rol' => 'required'
        ];
    }


    //No es necesario porque hemos añadidio el lang es

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe de contener al menos 5 caracteres',
            'apellidos.required' => 'Los apellidos son opbligatorios',
            'apellidos.min' => 'Los apellidos deben de contener al menos 5 caracteres',
            'edad.required' => 'La edad es obligatoria',
            'rol.required' => 'El rol es obligatorio'
        ];
    }


}
