<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidationFormRequest extends FormRequest
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
            'lugar' => 'required|min:5',
            'foto' => 'required'
        ];
    }


    //No es necesario porque hemos añadidio el lang es

    public function messages()
    {
        return [
            'lugar.required'=>'Por favor, introduce un lugar para la pista',
            'lugar.max'=>'EL campo lugar debe de ser de al menos 5 caracteres',
            'foto.required'=>'La foto es obligatoria para la pista'
        ];
    }


}
