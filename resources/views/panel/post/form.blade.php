@extends('panel.template.panel')


@section('css')

    <link href="{{ asset('assets/common/libraries/summernote/summernote.css') }}" rel="stylesheet">
@endsection


@section('title-page')
    Posts
@endsection


@section('breadcrumb')
    <li><a href="{{ route('panel.index') }}">Home</a></li>
    <li><a href="{{ route('posts.index') }}">Posts</a></li>
    <li class="active">{{ isset($post) ? 'Editar' : 'Novo' }} Post</li>
@endsection 

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3 class="panel-title">{{ isset($post) ? 'Editar Post' : 'Novo Post' }}</h3>
                </div>
                
                <div class="panel-body">
                
                    
                    @if (isset($post))
                        {!! Form::model($post, ['route' => ['posts.update', $post->id], 
                            'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['route' => 'posts.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    @endif
                    
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="col-sm-2 control-label">
                                Título: *
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                
                                @if ($errors->has('title'))
                                    <label class="error">
                                        {{ $errors->first('title') }}
                                    </label>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="col-sm-2 control-label">
                                Descrição: *
                            </label>
                            <div class="col-sm-10">
                                 {!! Form::textarea('description', null, ['id' => 'description']) !!}
                                 
                                 <div id="charNum"></div>
                                 
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


@section('js')

    <script type="text/javascript" src="{{ asset('assets/common/libraries/summernote/summernote.min.js') }}">
    </script>
    
    <script type="text/javascript">

        $(document).ready(function(){

            $('#description').summernote({
            	 toolbar: [
            		    ['style', ['bold', 'italic', 'underline', 'clear']],
            		    ['font', ['strikethrough', 'superscript', 'subscript']],
            		    ['fontsize', ['fontsize']],
            		    ['color', ['color']],
            		    ['para', ['ul', 'ol', 'paragraph']],
            		    ['height', ['height']]
            		  ],
            	  placeholder: 'Conteúdo do Post',
                  tabsize: 2,
                  height: 200,
                  minHeight: 100,             // set minimum height of editor
                  maxHeight: 300

            });


            //Contador de Caracteres para summernote
            $(".note-editable").keyup(function(e){

                var limiteCaracteres = 1000;
                var caracteres = $(this).text();
                var totalCaracteres = caracteres.length;

                
                //Check and Limit Charaters
                if(totalCaracteres > limiteCaracteres) {
                	$(this).text($(this).text().substring(0, limiteCaracteres));
                }

                var charRestantes = parseInt(limiteCaracteres) - parseInt(totalCaracteres);
                
              //Update value
                $("#charNum").text(charRestantes + ' caracteres restantes...');
            });

            $(".note-editable").trigger("keyup");
        });

    </script>
@endsection