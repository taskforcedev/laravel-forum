@extends($layout)

@section('content')

    <div class="row forum-post">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
            {{ $post->author->name }}
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h1>{{ $post->title }}</h1>
            {!! nl2br(e($post->body)) !!}
        </div>
    </div>

    <?php
        $replies = $post->replies;
        if ($replies->isEmpty()) {
            $replies = null;
        }
    ?>

    @if (isset($replies))

        @foreach ($replies as $reply)

            <div class="row forum-reply">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
                    {{ $reply->author->name }}
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <h1>{{ $reply->title }}</h1>
                    {!! nl2br(e($reply->body)) !!}
                </div>
            </div>

        @endforeach

    @endif

    @include('laravel-forum::forum/_addReply')
@stop
