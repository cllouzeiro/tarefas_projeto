<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\Sanitize;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetSenhaMail;

class SenhaController extends Controller
{
    public function index()
    {
        return view('auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        if(!$request->has('cpf'))
            return back()->withError('CPF não informado');

        $cpf = Sanitize::sanitizeCpf($request->get('cpf'));
        
        $user = User::where('cpf', $cpf)->first();

        if(!$user)
            return back()->withError('Usuário não localizado');

        $nova_senha = Str::random(8);

        $user->password = Hash::make($nova_senha);
        $user->update();

        $send = Mail::to($user->email)->send(new ResetSenhaMail($user, $nova_senha));
        
        return redirect(route('index'))->withSuccess("Você receberá um email com a sua nova senha!");
    }
}
