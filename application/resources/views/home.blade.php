@extends('layout.base')

@push('js-init')
    <script>
        $(document).on('click', '.visualizar-detalhes', function(){
            var tarefa = $(this).data('id');
            var url = '{{route("tarefas.returnDados")}}';

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': tarefa
                },
                success: function(response){

                    html = '<div>'+
                            '<small class="text-muted">Autor: ' + response.autor + '</small><br>'+
                            '<small class="text-muted">Data da Criação: ' + response.data_criacao + '</small><br>'+
                            '<small class="text-muted">Status: ' + response.status + '</small><br><br>'+
                            '<p>' + response.descricao + '</p>'+
                            '</div>';

                    $('#exampleModal .modal-body').empty();
                    $('#exampleModal .modal-title').empty();
                    $('#exampleModal .modal-body').append(html);
                    $('#exampleModal .modal-title').append(response.titulo);
                    $('#exampleModal').modal('show');
                }
            });

            return false;
        });

        $('.tarefa-deleta').on('click', function(){
            Swal.fire({
                title: 'Atenção!',
                html: 'Esta operação não poderá ser revertida.<br><h4><strong>Deseja realmente excluir a tarefa?</strong></h4>',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Excluir',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then( response => {
                var url = "{{route('tarefas.delete')}}";
                var id = $(this).data('id');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id': id
                    },
                    success: function(response){

                        Swal.fire({
                            html: response,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        }).then(response => {
                            location.reload();
                        });
                    },
                    error: function(response){
                        var msg = response.responseJSON;
                        
                        Swal.close();

                        Swal.fire({
                            html: msg,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        })
                    }
                });
            });

            return false;
        });
    </script>
@endpush

@section('conteudo')
<div class="container pb-5">
    <div class="row mt-5">
        @foreach ($status as $st)
            <div class="col">
                <div class="card shadown">
                    <div class="card-body">
                        <h5 class="card-title text-muted"><strong>{{$st['descricao']}}</strong></h5>
                        <h3 class="card-text text-right"><strong>{{$st['total']}}</strong></h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card col-12 p-4">
                <div class="card-title">
                    <h4 class="float-left"><strong>Tarefas Cadastradas</strong></h4>
                    <a href="{{route('tarefas.create')}}" class="btn btn-primary btn-sm float-right">
                        Cadastrar Tarefa
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Autor</th>
                                <th scope="col">
                                    Início /<br>
                                    Fim
                                </th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                @php
                                    $tarefa_dados = $tarefa->tarefaDados;
                                @endphp
                                <tr>
                                    <td>{{$tarefa_dados->titulo}}</td>
                                    <td>{{$tarefa_dados->autor()->first()->name}}</td>
                                    <td>
                                        {{date('d/m/Y', strtotime($tarefa_dados->data_inicio))}} <br>
                                        {{date('d/m/Y', strtotime($tarefa_dados->data_fim))}}
                                    </td>
                                    <td>{{$tarefa_dados->status()->first()->descricao}}</td>
                                    <td class="text-nowrap">
                                        <a href="" class="btn btn-primary btn-sm visualizar-detalhes" data-id="{{$tarefa_dados->id}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route('tarefas.show', encrypt($tarefa_dados->id))}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm tarefa-deleta" data-id="{{$tarefa_dados->id}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <span class="pull-right">{{$tarefas->links()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal detalhes de tarefa --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
@endsection
