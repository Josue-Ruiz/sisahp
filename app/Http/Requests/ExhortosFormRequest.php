<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhortosFormRequest extends FormRequest
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
            'n_oficio'          =>  ['required','integer'],
            'municipio'         =>  ['required','integer','min:1'],
            'edas'              =>  ['required','integer'],
            'costo_edas'        =>  ['required','integer'],
            'fecha'             =>  ['required','date_format:m/d/Y g:i A']
        ];
    }
}
