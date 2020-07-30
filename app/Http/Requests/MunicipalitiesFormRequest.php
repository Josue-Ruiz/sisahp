<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicipalitiesFormRequest extends FormRequest
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
            'clave'         =>    ['required','numeric', 'min:001','max:999'],
            'entidad'       =>    ['required','numeric'],
            'nombre'        =>    ['required','string','max:100','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s\,]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s\.]*$/'],
            'pob_total'     =>    ['required','integer'],
            'pob_agua'      =>    ['required','integer'],
            'presidente'    =>    ['required','string','max:100','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s\,]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s\.]*$/'],
            'delegado'      =>    ['required','string','max:100','regex:/^[A-Za-zÀ-ÿ\u00f1\u00d1\s\,]*[A-Za-zÀ-ÿ\u00f1\u00d1\s][A-Za-zÀ-ÿ\u00f1\u00d1\s\.]*$/']
        ];
    }
}
