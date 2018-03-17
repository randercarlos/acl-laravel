@extends('site.template.app')

@section('content')

<div class="container">

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->description }}</p><br />
    
    <b>Autor: {{ $post->user->name }}</b><br />
    
</div>
@endsection('content')
