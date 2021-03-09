<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Tarefas;
use App\Models\Users;
use App\Models\TarefaUsuario;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dados['tarefas'] = Auth::user()->tarefasUsuario()->paginate(15);

        $dados['status'][] = [
            'descricao' => 'Aberta',
            'total' => Tarefas::where('status', 1)->count()
        ];
        $dados['status'][] = [
            'descricao' => 'Em Desenvolvimento',
            'total' => Tarefas::where('status', 2)->count()
        ];
        $dados['status'][] = [
            'descricao' => 'Concluída',
            'total' => Tarefas::where('status', 3)->count()
        ];
        $dados['status'][] = [
            'descricao' => 'Em Atraso',
            'total' => Tarefas::where('status', 4)->count()
        ];
        
        return view('home', $dados);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->withSuccess('Voce saiu do sistema!');
    }
}
