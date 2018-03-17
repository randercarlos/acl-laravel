@extends('panel.template.panel')

@section('title-page')
    Usuários
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li class="active">Usuários</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">Listagem de Usuários</h3>
                </div>
                
                <div class="panel-body">
                
                    @include('panel.include.alerts')
                    
                    
                    @can('add_users')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="m-b-30">
                                <a href="{{ route('users.create') }}" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-plus"></i> Novo
                                </a>
                            </div>
                        </div>
                    </div>
                    @endcan
                
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive table-striped">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="25%">Nome</th>
                                            <th width="25%">Email</th>
                                            <th width="">Perfis</th>
                                            
                                            @can('edit_users', 'delete_users')
                                            <th width="11%" class="text-center">Ações</th>
                                            @endcan
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <td class="text-primary">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                               @forelse($user->roles as $role)
                                                    <span class="label label-{{ $role->name == 'admin' ? 'danger' : 
                                                        'primary'}}" style="margin-right: 5px;">
                                                        {{ $role->label }}
                                                    </span>
                                               @empty
                                                    Nenhum Perfil atribuído
                                               @endforelse
                                            </td>
                                            <td class="text-center">
                                                @if ($user->id != 1 && $user->name != 'admin')
                                                
                                                @can('edit_users')
                                                <a href="{{ route('user.roles', $user->id) }}" 
                                                    class="btn btn-default btn-circle"
                                                    data-toggle="tooltip" data-placement="top" title="Ver Permissões" 
                                                    data-original-title="Ver Permissões">
                                                    <i class="ion-ios7-paper-outline"></i>
                                                </a>
                                                
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-circle"
                                                    data-toggle="tooltip" data-placement="top" title="Editar" 
                                                    data-original-title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                @endcan
                                                
                                                @can('delete_users')
                                                <a href="{{ route('users.destroy', $user->id) }}"
                                                    class="btn btn-danger btn-circle deletar"
                                                    data-toggle="tooltip" data-placement="top" title="Deletar" 
                                                    data-original-title="Deletar">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                @endcan
                                                
                                                
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Nenhum usuário encontrado!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                <!-- Formulário necessário para se excluir um registro via método DELETE -->
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'id' => 'form_delete',
                                    'method' => 'DELETE']) !!}
                                    
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->

@endsection

@section('js')

<script type="text/javascript">


    $(document).ready(function(){

    	 //Warning Message
        $('.deletar').click(function(e){
            e.preventDefault();
            var link = $(this).attr('href');
            
            swal({   
                title: "",   
                text: "Deseja deletar esse registro ?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Sim, pode deletar!",
                cancelButtonText: "Não, cancele isso!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {

                // se o botão de confirmar foi clicado
                if (isConfirm) {

                    $('#form_delete').attr('action', link);

                    $('#form_delete').submit();
                }
                
            });
        });
            
    });

</script>

@endsection