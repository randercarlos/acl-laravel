@extends('auth.template.auth')

@section('content')

        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading bg-img"> 
                <div class="bg-overlay"></div>
                <h3 class="text-center m-t-10 text-white"> Login <strong>Laravel ACL</strong> </h3>
            </div> 


            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="{{ route('login') }}" method="POST">
                @csrf
                 
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback field-error">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" name="password" required placeholder="Senha"
                            class="form-control input-lg{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        
                        @if ($errors->has('password'))
                            <span class="invalid-feedback field-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-success">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Lembra-me nesse computador ?
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-lg w-lg waves-effect waves-light" type="submit">
                           Logar
                        </button>
                    </div>
                </div>

                    {{--
                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="{{ route('password.request') }}">
                            <i class="fa fa-lock m-r-5"></i> 
                            Esqueceu a senha ?
                        </a>
                    </div>
                    
                    <div class="col-sm-5 text-right">
                        <a href="{{ route('register') }}">Criar uma conta</a>
                    </div> --}}
                </div>
            </form> 
            </div>                                 
            
        </div>
@endsection
