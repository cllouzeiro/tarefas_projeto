@extends('layout.base')

@section('conteudo')
<div class="container pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card py-3 px-4 my-4">
                <div class="card-header">
                    <h4>Editar Perfil de Usuário</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('usuario.update.dados')}}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="nome">Nome</label>
                                <input class="form-control" type="text" name="name" id="nome" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-3">
                                <label for="cpf">CPF</label>
                                <input class="form-control cpf" type="text" name="cpf" id="cpf" value="{{$user->cpf}}">
                            </div>
                            <div class="form-group col-3">
                                <label for="telefone">Telefone</label>
                                <input class="form-control telefone" type="text" name="telefone" id="telefone" value="{{$user->telefone}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" name="email" id="telefone" value="{{$user->email}}">
                            </div>
                            <div class="form-group col text-right mt-4">
                                <button class="btn btn-primary" type="submit">Atualizar Dados</button>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('usuario.update.senha')}}" method="POST">
                        @csrf
                        <input type="hidden" name="cpf" value="{{$user->cpf}}">
                        <div class="text-right-end">
                            <div class="form-group col-4">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" name="password" id="senha">
                            </div>
                            <div class="form-group col-4">
                                <label for="confirmSenha">Confirmar senha</label>
                                <input class="form-control" type="password" name="password_confirmation" id="confirmSenha">
                            </div>
                            <div class="row">
                                <div class="form-group col-4 text-right pt-4">
                                    <button class="btn btn-primary" type="submit">Atualizar senha</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection