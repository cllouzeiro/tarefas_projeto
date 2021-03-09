@extends('layout.base')

@section('conteudo')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{asset('img/logo.png')}}" class="img-fluid col-6">
                    {{-- <span class="float-left">Login</span> --}}
                </div>
                <div class="card-body">
                    <div class="row text-center mb-3">
                        <div class="col-12">
                            <h4 class="text-muted">Cadastro de Usuário</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('register.create') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Nome</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="cpf">CPF</label>
                                <input id="cpf" type="text" class="form-control cpf @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus>
                            
                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                <label for="telefone">Telefone</label>
                                <input id="telefone" type="text" class="form-control telefone @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required autocomplete="telefone">
                            
                                @error('telefone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                <label for="email">E-mail</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="password">Senha</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group col-12">
                                <label for="password-confirm">Confirmar Senha</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 text-right">
                                <button type="submit" class="btn btn-primary ">
                                    Cadastrar
                                </button>
                            </div>
                            <div class="text-right col-12">
                                <a class="text-primary" href="{{route('login')}}">
                                    <small> <i class="fa fa-sign-in"></i> Voltar para Login</small>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
