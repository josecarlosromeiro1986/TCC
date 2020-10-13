<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'quantity' => [
                'required',
                'numeric',
            ],
            'description' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é obrigatória!',
            'name.string' => 'O Nome deve ser do tipo texto!',
            'quantity.required' => 'A quantidade é obrigatória!',
            'quantity.string' => 'A quantidade deve ser do tipo numérico!',
            'description.required' => 'A Descrição é obrigatória!',
            'description.string' => 'A Descrição deve ser do tipo texto!',
        ];
    }
}
