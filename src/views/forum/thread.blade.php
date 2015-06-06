@extends($layout)

@section('content')
    <h1>{{ $post_title }}</h1>

    @include('laravel-forum::forum/_addReply')
@stop