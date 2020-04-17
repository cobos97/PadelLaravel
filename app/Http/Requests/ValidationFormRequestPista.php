<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidationFormRequestPista extends FormRequest
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
            'descripcion' => 'required|max:191',
            'foto' => 'mimes:jpeg,png,jpg'
        ];
    }


    //No es necesario porque hemos añadidio el lang es

    public function messages()
    {
        return [
            'descripcion.max' => 'EL campo descripcion debe de ser como maximo 191 caracteres',
            'foto.mimes' => 'Solo se aceptan archivos jpeg, jpg o png'
        ];
    }


}