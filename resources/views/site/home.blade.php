@extends('site.template.app')

@section('content')
<div class="container">
    
    <h1 style="border-bottom: 1px solid gray; margin-bottom: 30px;">Listagem de Posts</h1>
    
    @forelse($posts as $post)
        @can('view_post', Post::class)
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            
            <b>Autor: {{ $post->user->name }}</b><br />
           
            <hr />
        @endcan
    @empty
        <p>Nenhum Post cadastrado!</p>
    @endforelse
    
</div>
@endsection('content')
