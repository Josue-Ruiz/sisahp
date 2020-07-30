<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VibrioCholeraeFormRequest extends FormRequest
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
            'localidad' => ['required','integer','min:1'],
            'domicilio' => ['required','string','max:300'],
            'fecha'     => ['required','date_format:m/d/Y g:i A']
        ];
    }
}
