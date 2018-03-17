@extends('panel.template.panel')


@section('css')
     <link href="{{ asset('assets/common/libraries/select2/select2.css') }}" rel="stylesheet" />
@endsection


@section('title-page')
    Usuários
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('users.index') }}">Usuários</a></li>
    <li class="active">{{ isset($user) ? 'Editar' : 'Novo' }} Usuário</li>
@endsection 


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">{{ isset($user) ? 'Editar Usuário' : 'Novo Usuário' }}</h3>
                </div>
                
                <div class="panel-body">
                
                    
                    @if (isset($user))
                        {!! Form::model($user, ['route' => ['users.update', $user->id], 
                            'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['route' => 'users.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
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
                        
                        
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="col-sm-2 control-label">
                                Email: *
                            </label>
                            <div class="col-sm-10">
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('email'))
                                    <label class="error">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-2 control-label">
                                Senha: *
                            </label>
                            <div class="col-sm-10">
                                 {!! Form::password('password', ['class' => 'form-control']) !!}
                                 
                                 @if ($errors->has('password'))
                                    <label class="error">
                                        {{ $errors->first('password') }}
                                    </label>
                                 @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                            <label for="confirm_password" class="col-sm-2 control-label">
                                Confirmar Senha: *
                            </label>
                            <div class="col-sm-10">
                                 {!! Form::password('confirm_password', ['class' => 'form-control']) !!}
                                 
                                 @if ($errors->has('confirm_password'))
                                    <label class="error">
                                        {{ $errors->first('confirm_password') }}
                                    </label>
                                 @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="perfis">
                                Perfis:
                            </label>
                            <div class="col-sm-10">
                                 {!! Form::select('perfis[]', $roles, isset($user) ? $user->roles : null, 
                                    ['class' => 'select2', 'data-placeholder' => 'Selecione um ou mais perfis...', 
                                    'multiple' => true, 'id' => 'perfis']) !!}
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


@section('js')
    
    <script src="{{ asset('assets/common/libraries/select2/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $(".select2").select2({
                width: '100%'
            });
            
        });

    </script>
@endsection