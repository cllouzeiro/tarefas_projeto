<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tarefas;

class TarefaUsuario extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'tarefa_usuario';

    protected $fillable = [
        'user_id',
        'tarefa_id'
    ];

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tarefaDados(){
        return $this->hasOne(Tarefas::class, 'id', 'tarefa_id');
    }
}
