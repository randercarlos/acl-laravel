@extends('panel.template.panel')

@section('title-page')
    Perfis
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('roles.index') }}">Perfis</a></li>
    <li class="active">Permissões</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Listagem das Permissões do Perfil {{--: <span class="label label-info">
                            {{ $role->label }}  --}}
                        </span>
                    </h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            <p class="lead">Perfil: 
                                <span class="text-primary"><b>
                                    {{ $role->label }}
                                    </b>
                                </span>
                            </p>
                            
                            <hr style="margin: 0 0 40px 0"/>
                            
                             {!! Form::open(['route' => ['role.savePermissions', $role->id], 'role' => 'form']) !!}
                            <div class="table-responsive table-striped">
                                <table class="table" id="table_role_permissions">
                                    <thead>
                                        <th width="30%">Módulo</th>
                                        <th class="text-center">Visualizar</th>
                                        <th class="text-center">Cadastrar</th>
                                        <th class="text-center">Alterar</th>
                                        <th class="text-center">Excluir</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Usuários</td>
                                        @foreach($users_permissions as $permission)
                                            <td class="text-center">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="role_permissions[]" type="checkbox" 
                                                        value="{{ $permission->id }}" 
                                                        {{ $permissions_role->contains($permission->id) 
                                                            ? 'checked="checked"' : '' }}>
                                                    <label></label>
                                                </div>
                                            </td>
                                        @endforeach    
                                        </tr>
                                        <tr>
                                            <td>Perfis</td>
                                        @foreach($roles_permissions as $permission)
                                            <td class="text-center">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="role_permissions[]" type="checkbox" 
                                                        value="{{ $permission->id }}"
                                                         {{ $permissions_role->contains($permission->id) 
                                                            ? 'checked="checked"' : '' }}>
                                                    <label></label>
                                                </div>
                                            </td>
                                        @endforeach    
                                        </tr>
                                        <tr>
                                            <td>Permissões</td>
                                        @foreach($permissions as $permission)
                                            <td class="text-center">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="role_permissions[]" type="checkbox" 
                                                        value="{{ $permission->id }}"
                                                        {{ $permissions_role->contains($permission->id) 
                                                            ? 'checked="checked"' : '' }}>
                                                    <label></label>
                                                </div>
                                            </td>
                                        @endforeach    
                                        </tr>
                                        <tr>
                                            <td>Posts</td>
                                        @foreach($posts_permissions as $permission)
                                            <td class="text-center">
                                                <div class="checkbox checkbox-primary">
                                                    <input name="role_permissions[]" type="checkbox" 
                                                        value="{{ $permission->id }}"
                                                        {{ $permissions_role->contains($permission->id) 
                                                            ? 'checked="checked"' : '' }}>
                                                    <label></label>
                                                </div>
                                            </td>
                                        @endforeach    
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-1 col-sm-11">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">
                                        Salvar Permissões
                                    </button>
                                </div>
                            </div>
                            
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->


@endsection