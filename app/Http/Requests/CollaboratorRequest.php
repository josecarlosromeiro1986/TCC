<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorRequest extends FormRequest
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
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users'
            ],
            'cpf' => [
                'required',
                //'unique:collaborators,cpf',
                'string',
                'max:14'
            ],
            'rg' => [
                'required',
                'string',
                'max:10'
            ],
            'phone' => [
                'required',
                'string',
                'max:15'
            ],
            'birth' => [
                'required',
                'date_format:Y-m-d'
            ],
            'office_id' => [
                'required',
                'exists:App\Office,id'
            ],
            'start' => [
                'required',
                'date_format:Y-m-d'
            ],
            'cep' => [
                'required',
                'string',
                'max:9'
            ],
            'address' => [
                'required',
                'string'
            ],
            'complement' => [
                'nullable',
                'string'
            ],
            'number' => [
                'required',
                'numeric'
            ],
            'neighborhood' => [
                'required',
                'string'
            ],
            'state' => [
                'required',
                'string'
            ],
            'city' => [
                'required',
                'string'
            ],
            'user' => [
                'required',
                'unique:collaborators,user',
                'string'
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
            'note' => [
                'nullable',
                'string'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é Obrigatório!',
            'name.string' => 'O Nome deve ser do tipo texto!',
            'email.required' => 'O E-mail é Obrigatório!',
            'email.email' => 'O E-mail deve ser válido!',
            'email.unique' => 'O E-mail informado já existe!',
            'cpf.required' => 'O é Obrigatório!',
            'cpf.unique' => 'O CPF informado já está cadastrado!',
            'cpf.string' => 'O CPF deve ser do tipo texto!',
            'cpf.max' => 'O CPF deve conter no máximo 14 caracteres!',
            'rg.required' => 'O RG é Obrigatório!',
            'rg.string' => 'O RG deve ser do tipo texto!',
            'rg.max' => 'O RG deve conter no máximo 10 caracteres!',
            'phone.required' => 'O Telefone é Obrigatório!',
            'phone.string' => 'O Telefone deve ser do tipo texto!',
            'phone.max' => 'O Telefone deve conter no máximo 15 caracteres!',
            'birth.required' => 'A Data de Nascimento é Obrigatória!',
            'birth.date_format' => 'A Data de Nascimento deve ser no formato AAAA-MM-DD!',
            'office_id.required' => 'O Cargo é Obrigatório!',
            'office_id.exists' => 'O Cargo informado não existe em nossa base de dados!',
            'start.required' => 'A Data de Início é Obrigatória!',
            'start.date_format' => 'A Data de Inicio deve ser no formato AAAA-MM-DD!',
            'cep.required' => 'O CEP é Obrigatório!',
            'cep.string' => 'O CEP deve ser do tipo texto!',
            'cep.max' => 'O CEP deve conter no máximo 09 caracteres!',
            'address.required' => 'O Endereço é Obrigatório!',
            'address.string' => 'O Endereço deve ser do tipo texto!',
            'complement.string' => 'O Complemento deve ser do tipo texto!',
            'number.required' => 'O Número é Obrigatório!',
            'number.numeric' => 'O Número deve ser do tipo numérico!',
            'neighborhood.required' => 'O Bairro é Obrigatório!',
            'neighborhood.string' => 'O Bairro deve ser do tipo texto!',
            'state.required' => 'O Estado é Obrigatório!',
            'state.string' => 'O Estado deve ser do tipo texto!',
            'city.required' => 'A Cidade é Obrigatória!',
            'city.string' => 'A Cidade deve ser do tipo texto!',
            'user.required' => 'O Nome de Usuário é Obrigatório!',
            'user.unique' => 'O Nome de Usuário já existe, favor escolha outro!',
            'user.string' => 'O Nome de Usuário deve ser do tipo texto!',
            'password.required' => 'A Senha é Obrigatória!',
            'password.string' => 'A Senha deve ser do tipo texto!',
            'password.min' => 'A Senha deve conter no minimo 8 caracteres!',
            'note.string' => 'A Observação deve ser do tipo texto!',
        ];
    }
}
