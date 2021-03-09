<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return  [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'min:14', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            
            'email.required' => 'O campo email é obrigatório!',
            'email.unique' => 'O email informado já foi cadastrado!',
            'email.email' => 'O email informado é inválido!',

            'password.confirmed' => 'As senha digitadas precisam ser iguais!',
            'password.required' => 'O campo senha e confirmação de senha precisam ser preenchidos!',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres!',
            
            'password_confirmation.required' => 'O campo confirmar senha precisam ser preenchidos!',
            'password_confirmation.min' => 'A senha deve conter no mínimo 8 caracteres!',
        ];
    }
}
