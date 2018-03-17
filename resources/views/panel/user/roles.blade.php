@extends('panel.template.panel')

@section('title-page')
    Usuários
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">Usuários</a></li>
    <li class="active">Perfis</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Listagem de Perfis {{-- de um Perfil: <span class="text-primary">{{ $permission->label }}</span>--}}
                    </h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
                            <h2 style="margin-bottom: 50px">
                                <small>Perfis do Usuário:</small> 
                                <small class="text-primary">{{ $user->name }}</small>
                            </h2>
                            <div class="table-responsive table-striped">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="15%">Nome</th>
                                            <th width="20%">Label</th>
                                            <th width="">Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @forelse($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-primary">{{ $role->label }}</td>
                                            <td>{{ $role->description }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Nenhum Perfil encontrado!</td>
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