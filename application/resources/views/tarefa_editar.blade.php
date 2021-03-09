@extends('layout.base')

@push('js-init')
    <script>
        $(document).on('click', '.excluir-linha', function(){
            var elementoPai = $(this).closest('tr');
            elementoPai.remove();

            return false;
        });

        $('#add-user').on('click', function(){
            var url = "{{route('usuario.busca')}}";
            var cpf = $('#numero-cpf').val();
            
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    '_token': '{{csrf_token()}}',
                    'cpf': cpf
                    },
                success: function(resposta){
                    var dados = resposta;

                    var html = '<tr>' +
                                '<input type="hidden" name="dados[user_id][]" value="' + dados.id + '">' +
                                '<td>' + dados.cpf + '</td>' +
                                '<td>' + dados.name + '</td>' +
                                '<td><a href="" class="text-danger excluir-linha"><i class="fa fa-trash"></i></a></td>' +
                                '</tr>';

                    $('#usuarios-table').append(html);
                },
                error: function(resposta){
                    // console.log(resposta.responseText);
                }
            });
        });
    </script>
@endpush

@section('conteudo')
<div class="container pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card py-3 px-4 my-4">
                <div class="card-header">
                    <h4>Editar Tarefas</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('tarefas.update')}}" method="POST" class="row">
                        @csrf
                        <input type="hidden" name="dados[tarefa_id]" value="{{$tarefa->id}}">
                        <div class="form-group col-12">
                            <label for="titulo">Título</label>
                            <input type="text" name="dados[titulo]" id="titulo" class="form-control" value="{{ $tarefa->titulo }}">
                        </div>
                        <div class="col-4">
                            <label for="status">Status</label>
                            {!! Form::select('dados[status]', $status, $tarefa->status, ['class' => 'custom-select']) !!}
                        </div>
                        <div class="form-group col-4">
                            <label for="data_inicio">Data de Início</label>
                            <input type="date" name="dados[data_inicio]" id="data_inicio" class="form-control" value="{{ $tarefa->data_inicio }}">
                        </div>
                        <div class="form-group col-4">
                            <label for="data_fim">Data do Fim</label>
                            <input type="date" name="dados[data_fim]" id="data_fim" class="form-control" value="{{ $tarefa->data_fim }}">
                        </div>
        
                        {{-- <div class="input-group col-12 justify-content-end">
                            <input type="text" class="form-control col-3 cpf" id="numero-cpf" placeholder="Digite o CPF">
                            <div class="input-group-append">
                                <a class="btn btn-outline-secondary" id="add-user" type="button">Adicionar</a>
                            </div>
                        </div> --}}
        
                        <div class="form-group col-6">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" name="dados[descricao]" id="descricao" rows="10"> {{ $tarefa->descricao }}</textarea>
                        </div>
        
                        <div class="col-6 pt-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control cpf" id="numero-cpf" placeholder="Digite o CPF">
                                <div class="input-group-append">
                                    <a class="btn btn-outline-secondary" id="add-user" type="button">Adicionar Usuário</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>CPF</th>
                                        <th>Nome</th>
                                    </thead>
                                    <tbody id="usuarios-table">
                                        @foreach ($tarefa_usuarios as $usuario)
                                            @php
                                                $user = $usuario->usuario
                                            @endphp
                                            <tr>
                                                <input type="hidden" name="dados[user_id][]" value="{{$user->id}}">
                                                <td>{{$user->cpf}}</td>
                                                <td>{{$user->name}}</td>
                                                <td><a href="" class="text-danger excluir-linha"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
                        <div class="form-group col-12">
                            <button class="btn btn-success btn-sm float-right">Atualizar Tarefa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
