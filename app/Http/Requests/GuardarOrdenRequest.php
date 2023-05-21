<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarOrdenRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tipo' => ['required','max:25', Rule::in(['tienda','casa'])],
            /* 'direccion' => [Rule::requiredIf($this->tipo == 'casa'),'max:100'], */
            /* 'estado' => Rule::in(['Procesando Pedido','Preparando productos','Enviando a la tienda...','Pedido en tienda','Recogido']), */
            /* 'total' => ['required','numeric'], */
            'user_id' => ['required','integer'],
            'productos_id' => ['required'],
            'productos_array' => ['required'],
        ];
    }
}
