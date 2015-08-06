@extends($layout)

@section('breadcrumbs')
<?php
    $forum = $post->forum;
?>
    <ol class="breadcrumb">
        <li><a href="{{ route('laravel-forum.index') }}">Forums</a></li>
        <li><a href="{{ route('laravel-forum.view', $forum->id) }}">{{ $forum->name }}</a></li>
        <li class="active">{{ $post->title }}</li>
    </ol>
@stop

@section('content')
    @if (method_exists($user, 'can') && ($user->can('administrate-forum') || $user->can('moderate-forum')))
        <span class="pull-right">
            <button class="btn btn-danger">Delete</button>
            <button class="btn btn-warning">Lock</button>
        </span>
    @endif

    <div class="row forum-post">
        <div class="forum-heading">
            <h2>{{ $post->title }}</h2>
            By {{ $post->author->name }} @ {{ $post->created_at }}
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg2">
            Author: {{ $post->author->name }}
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
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
