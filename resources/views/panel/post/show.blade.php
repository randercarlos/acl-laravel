@extends('panel.template.panel')


@section('title-page')
    Posts
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('posts.index') }}">Posts</a></li>
    <li class="active">Detalhe</li>
@endsection 

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">Visualizar Post</h3>
                </div>
                
                <div class="panel-body">
                
                    <h2>
                        <span class="">{{ $post->title }}</span>
                    </h2>
                    
                    <div class="post-info-container" style="margin-bottom: 40px">
                        <ul class="list-inline list-unstlyed post-info">
                            <li>
                                <i class="fa fa-user"></i>
                                por <span class="text-primary">{{ $post->user->name }}</span>
                            </li>
                            <li>
                                <i class="fa fa-clock-o"></i>{{ $post->created_at }}
                            </li>
                        </ul>
                    </div>
                        
                    <p>
                        {!! $post->description !!}
                    </p>
                    
                    
                    <div class="form-group m-b-0" style="margin: 20px 0 0 0">
                        <div class="col-sm-12">
                            <a href="{{ route('posts.index') }}" class="btn btn-primary waves-effect waves-light">
                                Voltar para Listagem de Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->


@endsection
