@extends($layout)

@section('content')
    <h1>{{ $post->title }}</h1>

    @include('laravel-forum::forum/_addReply')
@stop
