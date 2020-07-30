<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidualChlorineFormRequest extends FormRequest
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
             'municipio' => ['required','integer','min:1'],
             'localidad' => ['required','integer','min:1'],
             'calle'     => ['required','integer','min:1'],
             'fecha'     => ['required','date_format:m/d/Y g:i A'],
             'valor'     => ['required','string','max:100'],
             'ss'        => ['required','boolean'],
             'causas'    => ['required', 'string','max:300'], 
             'acciones'  => ['required', 'string','max:300'],
             'analisis'  => ['required','boolean']
        ];
    }
}
