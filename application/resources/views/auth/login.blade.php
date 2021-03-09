@extends('layout.base')

@section('conteudo')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadown">
                <div class="card-header text-center">
                    <img src="{{asset('img/logo.png')}}" class="img-fluid col-6">
                    {{-- <span class="float-left">Login</span> --}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="password">Senha</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col text-right">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <a href="{{route('recuperar.senha')}}" class="float-right text-primary">
                                    <small>
                                        <i class="fa fa-key"></i>
                                        Esqueci minha senha
                                    </small>
                                </a>   
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <a href="{{route('register')}}" class="float-left btn btn-success">Cadastre-se</a>
                                
                                <button type="submit" class="btn btn-primary float-right">
                                    Acessar
                                </button>
    
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col text-center">
                                <a href="" class="">Esqueci minha senha</a>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
