@extends($layout)

@section('breadcrumbs')
<?php
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
                    Author: {{ $post->author->name }}
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="border-left: 1px solid #333">
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
    ?>

    @if (isset($replies))

        @foreach ($replies as $reply)

            <div class="panel panel-info forum-reply">
                <div class="panelbody">
                    <div class="row forum-reply">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
                            {{ $reply->author->name }}
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            {!! nl2br(e($reply->body)) !!}
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    @endif

    @if (!$locked)
        @include('laravel-forum::forum/_addReply')
    @endif
@stop
