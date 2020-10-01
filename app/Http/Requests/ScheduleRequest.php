<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'start' => [
                'required',
                'after:'.date('Y-m-d\TH:i:s'),
            ],
            'end' => [
                'required',
                'after:'.date('Y-m-d\TH:i:s'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'start.required' => 'A data de início é obrigatória!',
            'start.after' => 'A data de início não pode ser menor que a data atual!',
            'end.required' => 'A data de termino é obrigatória!',
            'end.after' => 'A data de termino não pode ser menor que a data atual!',
        ];
    }
}
