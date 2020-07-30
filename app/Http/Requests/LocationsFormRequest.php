<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationsFormRequest extends FormRequest
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
            'nombre'    =>  ['required', 'string','max:100'],
            'municipio' =>  ['required','numeric','min:1'],
            'clave'     =>  ['required','string','max:100'],
            'pob_total' =>  ['required','numeric'],
            'latitud'   =>  ['required','numeric'],
            'longitud'  =>  ['required','numeric'],
        ];
    }
}
