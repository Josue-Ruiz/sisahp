<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarFormRequest extends FormRequest
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
            'asunto'        => ['required','string','max:100'],
            'fec_inicio'    => ['required','date'],
            'fec_final'     => ['required','date','after_or_equal:fec_inicio']
        ];
    }
}
