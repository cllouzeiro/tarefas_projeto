<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\Sanitize;
use Illuminate\Support\Facades\Hash;

//Models
use App\Models\User;

class UserController extends Controller
{
    public function perfil()
    {
        $dados['user'] = Auth::user();

        return view('perfil', $dados);
    }

    public function buscaUsuario(Request $request)
    {
        if(!$request->has('cpf') || !$request->get('cpf'))
            return response()->json('Usuario não informado', 400);

        $cpf = Sanitize::sanitizeCpf($request->get('cpf'));

        $user = User::where('cpf', $cpf)->first(['id', 'name', 'cpf'])->toArray();

        if(!$user)
            return response()->json('Usuario não localizado', 400);

        return response()->json($user, 200);
    }

    public function updateDados(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'min:14'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ],[
            'name.required' => 'O campo nome é obrigatório!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            
            'email.required' => 'O campo email é obrigatório!',
            'email.unique' => 'O email informado já foi cadastrado!',
            'email.email' => 'O email informado é inválido!',
        ]);

        $cpf = Sanitize::sanitizeCpf($request->get('cpf'));

        $user = User::where('cpf', $cpf)->first();

        if(!$user)
            return back()->withErrors("Usuário não localizado!");

        $update = $user->update([
            'name' => $request->get('name'),
            'cpf' => $cpf,
            'email' => $request->get('email'),
        ]);

        if(!$update)
            return back()->withErrors("Erro ao atualizar dados!");

        return back()->withSuccess("Cadastro Atualizado com sucesso!");
    }

    public function updateSenha(Request $request)
    {
        $validate = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ],[

            'password.confirmed' => 'As senha digitadas precisam ser iguais!',
            'password.required' => 'O campo senha e confirmação de senha precisam ser preenchidos!',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres!',
            
            'password_confirmation.required' => 'O campo confirmar senha precisam ser preenchidos!',
            'password_confirmation.min' => 'A senha deve conter no mínimo 8 caracteres!',
        ]);

        $cpf = Sanitize::sanitizeCpf($request->get('cpf'));

        $user = User::where('cpf', $cpf)->first();

        if(!$user)
            return back()->withErrors("Usuário não localizado!");

        $update = $user->update([
            'password' => Hash::make($request->get('password')),
        ]);

        if(!$update)
            return back()->withErrors("Erro ao atualizar senha!");

        return back()->withSuccess("Senha atualizada com sucesso!");
    }
}
