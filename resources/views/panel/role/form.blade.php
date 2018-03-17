@extends('panel.template.panel')

@section('title-page')
    Perfis
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('roles.index') }}">Perfis</a></li>
    <li class="active">{{ isset($role) ? 'Editar' : 'Novo' }} Perfil</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">{{ isset($role) ? 'Editar Perfil' : 'Novo Perfil' }}</h3>
                </div>
                
                <div class="panel-body">
                
                    
                    @if (isset($role))
                        {!! Form::model($role, ['route' => ['roles.update', $role->id], 
                            'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['route' => 'roles.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    @endif
                    
                       <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">
                                Nome: *
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('name'))
                                    <label class="error">
                                        {{ $errors->first('name') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                            <label for="label" class="col-sm-2 control-label">
                                Label: *
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('label', null, ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('label'))
                                    <label class="error">
                                        {{ $errors->first('label') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="col-sm-2 control-label">
                                Descrição:
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('description'))
                                    <label class="error">
                                        {{ $errors->first('description') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                    Salvar
                                </button>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div> <!-- End row -->


@endsection