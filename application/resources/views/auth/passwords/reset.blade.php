@extends('layout.base')

@section('conteudo')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center bg-transparent border-none">
                    <img src="{{asset('img/logo.png')}}" class="img-fluid col-6">
                    {{-- <span class="float-left">Login</span> --}}
                </div>

                <div class="card-body">
                    <div class="row text-center mb-3">
                        <div class="col-12">
                            <h4 class="text-muted">Recuperar Senha</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('reset.senha') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="cpf">Informe seu CPF</label>
                                <input id="cpf" type="cpf" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ $email ?? old('cpf') }}" required autocomplete="cpf" autofocus>
    
                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group col-12 text-right">
                                <button type="submit" class="btn btn-primary mb-2 mt-2">
                                    Recuperar Senha
                                </button>
                                <br>
                                <a href="{{route('index')}}" class="text-primary">
                                   <small><i class="fa fa-sign-in"></i> Voltar para Login</small> 
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
