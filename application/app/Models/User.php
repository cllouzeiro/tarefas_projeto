<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Models
use App\Models\Tarefas;
use App\Models\TarefaUsuario;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'telefone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function firstname()
    {
        return explode(' ', $this->name)[0];

    }

    public function tarefasAutor()
    {
       return $this->hasMany(Tarefas::class, 'autor', 'id');
    }

    public function tarefasUsuario()
    {
       return $this->hasMany(TarefaUsuario::class, 'user_id', 'id');
    }
}
