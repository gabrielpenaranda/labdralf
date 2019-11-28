<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePruebaDiluenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::user())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ph_prueba' => "numeric",
            'conductividad_prueba' => "numeric",
            'plt_1_prueba' => "numeric",
            'plt_2_prueba' => "numeric",
            'plt_3_prueba' => "numeric",
            'plt_4_prueba' => "numeric",
            'plt_5_prueba' => "numeric",
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ph_prueba.numeric' => "El valor de PH debe ser numérico",
            'conductividad_prueba.numeric' => "El valor de conductividad debe ser numérico",
            'plt_1_prueba.numeric' => "El valor PLT 1 debe ser numérico",
            'plt_2_prueba.numeric' => "El valor PLT 2 debe ser numérico",
            'plt_3_prueba.numeric' => "El valor PLT 3 debe ser numérico",
            'plt_4_prueba.numeric' => "El valor PLT 4 debe ser numérico",
            'plt_5_prueba.numeric' => "El valor PLT 5 debe ser numérico",
        ];
    }
}
