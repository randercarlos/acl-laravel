@extends('panel.template.panel')

@section('title-page')
    Permissões
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('permissions.index') }}">Permissões</a></li>
    <li class="active">{{ isset($permission) ? 'Editar' : 'Novo' }} Permissão</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">{{ isset($permission) ? 'Editar Permissão' : 'Novo Permissão' }}</h3>
                </div>
                
                <div class="panel-body">
                
                        {!! Form::model($permission, ['route' => ['permissions.update', $permission->id ], 
                            'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT']) !!}
                    
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">
                                Nome: *
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('name', null, ['class' => 'form-control', 'disabled' => true]) !!}
                                
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