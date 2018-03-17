@extends('auth.template.auth')

@section('content')

<div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                   <h3 class="text-center m-t-10 text-white"> Criar uma nova conta </h3>
                </div> 


                <div class="panel-body">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('username') ? ' is-invalid' : '' }}" 
                                type="text" required="" placeholder="Nome de Usuário" name="name" id="name"
                                value="{{ old('name') }}">
                        </div>
                        
                        @if ($errors->has('name'))
                            <span class="field-error">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                      
                      
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                type="email" required="" placeholder="Email" name="email" id="email"  
                                value="{{ old('email') }}">
                        </div>
                        
                        @if ($errors->has('email'))
                            <span class="field-error">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                 id="password" type="password" required="" placeholder="Senha"  name="password">
                        </div>
                        
                        @if ($errors->has('password'))
                            <span class="field-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control input-lg" 
                                placeholder="Confirmar Senha" name="password_confirmation" id="password_confirmation" 
                                required >
                        </div>
                    </div>
                    

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox-signup" type="checkbox" checked="">
                                <label for="checkbox-signup">
                                    Eu aceito <a href="#">os Termos e Condições deste Site</a>
                                </label>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-success waves-effect waves-light btn-lg w-lg" type="submit">
                                Registrar
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-center">
                            <a href="{{ route('login') }}">Já possui uma conta ?</a>
                        </div>
                    </div>
                </form> 
                </div>                                 
                
            </div>
            
            
            
            
{{--            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

--}}
@endsection
