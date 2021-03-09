<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('index');

Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::group([
    'namespace' => 'App\Http\Controllers',
], function(){

    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::post('/create', 'Auth\RegisterController@create')->name('register.create');

    Route::group([
        'middleware' => 'auth'
    ], function(){

        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/logout', 'HomeController@logout')->name('logout');

        Route::group([
            'prefix' => '/perfil'
        ], function(){
            Route::get('/', 'UserController@perfil')->name('usuario.perfil');
            Route::post('/update-dados', 'UserController@updateDados')->name('usuario.update.dados');
            Route::post('/update-senha', 'UserController@updateSenha')->name('usuario.update.senha');
        });

        //Busca Usuarios
        Route::post('/busca-usuario', 'UserController@buscaUsuario')->name('usuario.busca');
        
        Route::group([
            'prefix' => '/tarefas'
        ], function(){
            Route::get('/cadastro', 'TarefasController@create')->name('tarefas.create');
            Route::post('/store', 'TarefasController@store')->name('tarefas.store');
            Route::post('/delete', 'TarefasController@delete')->name('tarefas.delete');
            Route::get('/show/{id}', 'TarefasController@show')->name('tarefas.show');
            Route::post('/update', 'TarefasController@update')->name('tarefas.update');
            Route::post('/returnDados', 'TarefasController@returnDados')->name('tarefas.returnDados');
        });
    });

    Route::get('/recuperar-senha', 'SenhaController@index')->name('recuperar.senha');
    Route::post('/reset-senha', 'SenhaController@reset')->name('reset.senha');
});
