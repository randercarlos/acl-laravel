@extends('panel.template.panel')

@section('title-page')
    Permissões
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li class="active">Permissões</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">Listagem de Permissões</h3>
                </div>
                
                <div class="panel-body">
                
                    @include('panel.include.alerts')
                         
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive table-striped">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="15%">Nome</th>
                                            <th width="30%">Label</th>
                                            <th width="">Perfis</th>
                                            
                                            @can('view_permissions', 'edit_permissions')
                                            <th width="11%" class="text-center">Ações</th>
                                            @endcan
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td class="text-primary">{{ $permission->label }}</td>
                                            <td>
                                               @forelse($permission->roles as $role)
                                                    <span class="label label-{{ $role->name == 'admin' ? 'danger' : 
                                                        'primary'}}" style="margin-right: 5px;">
                                                        {{ $role->label }}
                                                    </span>
                                               @empty
                                                    Nenhum Perfil possui essa permissão
                                               @endforelse
                                            </td>
                                            <td class="text-center">
                                            
                                                <a href="{{ route('permission.roles', $permission->id) }}" 
                                                    class="btn btn-default btn-circle"
                                                    data-toggle="tooltip" data-placement="top" 
                                                    title="Ver Perfis que possuem essa permissão" 
                                                    data-original-title="Ver Permissões">
                                                    <i class="ion-ios7-paper-outline"></i>
                                                </a>
                                                
                                                @can('edit_users')
                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                    class="btn btn-warning btn-circle"
                                                    data-toggle="tooltip" data-placement="top" title="Editar" 
                                                    data-original-title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                @endcan
                                                
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Nenhuma Permissão encontrada!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->

@endsection
