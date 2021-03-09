<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helpers\Sanitize;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
    
    public function create(UserRequest $request)
    {
        $data = $request->all();
        
        $create = User::create([
            'name' => Sanitize::sanitizeNome($data['name']),
            'cpf' => Sanitize::sanitizeCpf($data['cpf']),
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'password' => Hash::make($data['password']),
        ]);

        if(!$create)
            return back()->withError("Ocorreu um erro ao salvar seus dados. Tente novamnete!");

        return redirect(route('index'))->withSuccess("Cadastro salvo com sucesso!");
    }
}
