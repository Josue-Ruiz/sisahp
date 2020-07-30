<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StreetsFormRequests extends FormRequest
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
            'nombre'        =>  ['required','string','max:300'],
            'localidad'     =>  ['required','numeric','min:1'],
            'latitud'       =>  ['required','string'],
            'longitud'      =>  ['required','string'],
        ];
    }
}
