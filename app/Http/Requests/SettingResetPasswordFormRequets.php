<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingResetPasswordFormRequets extends FormRequest
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
            'actual' => ['required','string','min:6','max:50'],
            'contrasenia' => ['required','string','min:6','max:50'],
            'confirmar_contrasenia' => ['required','string','min:6','max:50','same:contrasenia']
        ];
    }
}
