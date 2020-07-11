<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfficeRequest extends FormRequest
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
            'description' => [
                'required',
                'string',
            ],
            'access_id' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'A descrição é obrigatória!',
            'description.string' => 'A descrição deve ser do tipo texto!',
            'access.required' => 'O acesso é obrigatório!',
        ];
    }
}
