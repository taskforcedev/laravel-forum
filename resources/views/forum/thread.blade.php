@extends($layout)

@section('breadcrumbs')
<?php
    $postCounts = [];

    /* Add Post Authors post count to postCounts array */
    $postCounts[$post->author->id] = $userHelper->getPostCount($post->author->id);

    $forum = $post->forum;
    $body = $sanitizer->sanitize($post->body);
    $sticky = (bool)$post->sticky;
    $locked = (bool)$post->locked;
    if ($locked) {
        $title = 'Locked: ' . $post->title;
    } else {
        if ($sticky) {
            $title = 'Sticky: ' . $post->title;
        } else {
            $title = $post->title;
        }
    }
?>
    <ol class="breadcrumb">
        <li><a href="{{ route('laravel-forum.index') }}">Forums</a></li>
        <li><a href="{{ route('laravel-forum.view', $forum->id) }}">{{ $forum->name }}</a></li>
        <li class="active">{{ $post->title }}</li>
    </ol>
@stop

@section('content')
    <div class="panel panel-primary forum-post">
        <div class="panel-heading">
            <h2>{{ $title }} @include('laravel-forum::forum.thread._actions')  </h2>
            By {{ $post->author->name }} @ {{ $post->created_at }}
        </div>
        <div class="panel-body">
            <div class="row forum-post">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
                    {{ $post->author->name }}<br/>
                    Posts: {{ $postCounts[$post->author->id] }}
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    {!! nl2br($body) !!}
                </div>
            </div>
        </div>
    </div>

    <?php
        $replies = $post->replies;
        if ($replies->isEmpty()) {
            $replies = null;
        }
        $replyCounter = 1;
    ?>

    @if (isset($replies))

        @foreach ($replies as $reply)

            <?php $body = $sanitizer->sanitize($reply->body); ?>
            <div class="panel panel-info forum-reply">
                <div class="panel-heading">
                    Reply #{{ $replyCounter }} by {{ $reply->author->name }} @ {{ $reply->created_at }}
                </div>
                <div class="panel-body">
                    <div class="row forum-reply">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
                            {{ $reply->author->name }}<br/>
                            Post: {{ $postCounts[$reply->author->id] }}
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            {!! nl2br($body) !!}
                        </div>
                    </div>
                </div>
            </div>

            <?php $replyCounter++; ?>

        @endforeach

    @endif

    @if (!$locked)
        @include('laravel-forum::forum.thread._addReply')
    @endif
@stop

@section('scripts')
    @include('laravel-forum::partials.scripts._wysiwyg')
@endsection
