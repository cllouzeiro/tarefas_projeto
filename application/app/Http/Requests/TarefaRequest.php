<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
            'dados.titulo' => 'required|string|max:255',
            'dados.data_inicio' => 'required|date',
            'dados.data_fim' => 'required|date',
            'dados.descricao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'dados.titulo.required' => 'O título da tarefa é obrigatório!',
            'dados.titulo.max' => 'O título da tarefa deve conter no máximo 255 caracteres!',
            'dados.data_inicio.required' => 'A data de inicio da tarefa é obrigatório!',
            'dados.data_inicio.required' => 'A data de inicio da tarefa deve ser uma data válida!',
            'dados.data_fim.required' => 'A data de fim da tarefa é obrigatório!',
            'dados.data_fim.required' => 'A data de fim da tarefa deve ser uma data válida!',
            'dados.descricao.required' => 'A descrição da tarefa é obrigatório!',
        ];
    }
}
