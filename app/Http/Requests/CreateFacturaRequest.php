<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFacturaRequest extends FormRequest
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
            'numero_factura' => "required|numeric|unique:facturas,numero_factura",
            'monto_factura' => "required|numeric",
            'iva_factura' => "required|numeric",
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
            'numero_factura.required' => 'Introduzca el número de factura',
            'numero_factura.numeric' => 'El número de factura debe estar en formato numérico',
            'numero_factura.unique' => 'El número de factura ya está incluido',
            'monto_factura.required' => 'Introduzca el monto de la factura',
            'monto_factura.numeric' => 'El monto de factura debe ser un número',
            'iva_factura.required' => 'Introduzca el IVA de la factura',
            'iva_factura.numeric' => 'El IVA de factura debe ser un número',
        ];
    }
}
