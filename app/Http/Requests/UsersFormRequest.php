<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersFormRequest extends FormRequest
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
            'rol'                   =>  ['required','numeric','min:1'],
            'municipio'             =>  ['required_without:jurisdiccion','numeric','min:1'],
            'jurisdiccion'          =>  ['required_without:municipio','numeric','min:1'],
            'nombre'                =>  ['required','max:100','string','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s]*$/'],
            'apellido_p'            =>  ['required','max:50','string','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s]*$/'],
            'apellido_m'            =>  ['required','max:50','string','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s]*$/'],
            'correo'                =>  ['required','max:100','email','regex:/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/'],
            'usuario'               =>  ['required','max:50','string'],
            'contrasenia'           =>  ['required','string','min:6','max:50'],
            'confirmar_contrasenia' =>  ['required','string','same:contrasenia'],
        ];

    }
}
