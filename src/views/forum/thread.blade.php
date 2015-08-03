@extends($layout)

@section('content')
    <h1>{{ $post->title }}</h1>

    {{ $post->body }}

    @include('laravel-forum::forum/_addReply')
@stop
