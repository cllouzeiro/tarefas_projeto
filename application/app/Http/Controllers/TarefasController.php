<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Tarefas;
use App\Models\Users;
use App\Models\TarefaUsuario;
use App\Models\Status;

use App\Http\Requests\TarefaRequest;

class TarefasController extends Controller
{
    public function create()
    {
        $dados['status'] = Status::pluck('descricao', 'id')->toArray();
        
        return view('tarefas', $dados);
    }

    public function store(TarefaRequest $request)
    {
        $dados = $request->get('dados');

        $tarefa = Tarefas::create([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_inicio' => $dados['data_inicio'],
            'data_fim' => $dados['data_fim'],
            'autor' => Auth::user()->id,
            'status' => $dados['status']
        ]);

        TarefaUsuario::create([
            'user_id' => $tarefa->autor,
            'tarefa_id' => $tarefa->id
        ]);

        if($request->has('dados.user_id'))
        {
            foreach ($dados['user_id'] as $user_id) {
                $verifica = TarefaUsuario::where('user_id', $user_id)->where('tarefa_id', $tarefa->id)->first();

                if($verifica)
                    continue;

                TarefaUsuario::create([
                    'user_id' => $user_id,
                    'tarefa_id' => $tarefa->id
                ]);
            }
        }
        
        return back()->withSuccess('Tarefa cadastrada com sucesso!');
    }

    public function show($id)
    {
        $tarefa_id = decrypt($id);

        $dados['tarefa'] = Tarefas::find($tarefa_id);
        $dados['tarefa_usuarios'] = TarefaUsuario::where('tarefa_id', $tarefa_id)->get();
        $dados['status'] = Status::pluck('descricao', 'id')->toArray();
        
        return view('tarefa_editar', $dados);
    }

    public function update(TarefaRequest $request)
    {
        $dados = $request->get('dados');

        $tarefa = Tarefas::find($dados['tarefa_id']);

        if(!$tarefa)
            return back()->withErrors('Tarefa não localizada!');

        $tarefa->update([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_inicio' => $dados['data_inicio'],
            'data_fim' => $dados['data_fim'],
            'autor' => Auth::user()->id,
            'status' => $dados['status']
        ]);

        $usuariosTarefa = TarefaUsuario::where('tarefa_id', $tarefa->id)
        ->get();

        foreach ($usuariosTarefa as $usuarioTar) {
            $usuarioTar->delete();
        }

        if($request->has('dados.user_id'))
        {
            foreach ($dados['user_id'] as $user_id) {
                TarefaUsuario::create([
                    'user_id' => $user_id,
                    'tarefa_id' => $tarefa->id
                ]);
            }
        }
        
        return back()->withSuccess("Tarefa atualizada com sucesso!");
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');

        $tarefa = Tarefas::find($id);

        if(!$tarefa)
            return response()->json('Tarefa não localizada!', 400);

        $tarefa_usuarios = TarefaUsuario::where('tarefa_id')->get();

        foreach($tarefa_usuarios as $tf_us)
        {
            $tf_us->delete();
        }

        $tarefa->delete();

        return response()->json('Tarefa excluída com sucesso!', 200);
    }

    public function returnDados(Request $request)
    {
        $id = $request->get('id');

        $tarefa = Tarefas::find($id);

        if(!$tarefa)
            return response()->json('Tarefa não localizada!', 400);

        $dados = [
            'titulo' => $tarefa->titulo,
            'descricao' => $tarefa->descricao,
            'status' => $tarefa->status()->first()->descricao,
            'autor' => $tarefa->autor()->first()->name,
            'data_criacao' => $tarefa->created_at->format('d/m/Y'),
        ];

        return response()->json($dados, 200);
    }
}
