<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Status;

class Tarefas extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'tarefas';

    protected $fillable = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'autor',
        'status'
    ];

    public function autor(){
        return $this->hasOne(User::class, 'id', 'autor');
    }

    public function status(){
        return $this->hasOne(Status::class, 'id', 'status');
    }
}
