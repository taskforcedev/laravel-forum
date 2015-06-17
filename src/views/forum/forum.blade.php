@extends($layout)

@section('content')
    <h1>{{ $forum->name }}</h1>

    <?php
        $posts = $forum->posts;
    ?>
@stop