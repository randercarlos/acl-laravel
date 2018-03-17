@extends('panel.template.panel')

@section('title-page')
    Perfis
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li class="active">Perfis</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">Listagem de Perfis</h3>
                </div>
                
                <div class="panel-body">
                
                    @include('panel.include.alerts')
                    
                    @can('add_roles')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="m-b-30">
                                <a href="{{ route('roles.create') }}" class="btn btn-success waves-effect waves-light">
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
                                            <th width="15%">Nome</th>
                                            <th width="20%">Label</th>
                                            <th>Descrição</th>
                                            
                                            @can('edit_roles', 'delete_roles')
                                            <th width="11%" class="text-center">Ações</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-primary">{{ $role->label }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td class="text-center">
                                                
                                                @can('edit_roles')
                                                <a href="{{ route('role.permissions', $role->id) }}" 
                                                    class="btn btn-default btn-circle" 
                                                    data-toggle="tooltip" data-placement="top"  
                                                    data-original-title="Editar Permissões deste Perfil"
                                                    title="Editar Permissões deste Perfil" >
                                                    <i class="fa fa-list-alt"></i>
                                                </a>
                                                
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-warning btn-circle"
                                                    data-toggle="tooltip" data-placement="top" title="Editar" 
                                                    data-original-title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </a> 
                                                @endcan
                                                
                                                @can('delete_roles')
                                                <a href="{{ route('roles.destroy', $role->id) }}"
                                                    class="btn btn-danger btn-circle deletar"
                                                    data-toggle="tooltip" data-placement="top" title="Deletar" 
                                                    data-original-title="Deletar">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Nenhum Perfil encontrado!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                
                                <!-- Formulário necessário para se excluir um registro via método DELETE -->
                                {!! Form::open(['route' => ['roles.destroy', $role->id], 'id' => 'form_delete',
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