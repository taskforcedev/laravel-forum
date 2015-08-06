@extends($layout)

@section('breadcrumbs')
<?php
    $forum = $post->forum;
    $sticky = ($post->sticky === 1 || $post->sticky === true);
    $locked = ($post->locked === 1 || $post->locked === true);
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
    @if (method_exists($user, 'can') && ($user->can('administrate-forum') || $user->can('moderate-forum')))
        <span class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Actions</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    @if ($sticky)
                        <li><a href="#"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Un-sticky</a></li>
                    @else
                        <li><a href="#"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Sticky</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Lock</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a></li>
                </ul>
            </div>
        </span>
    @endif

    <div class="row forum-post">
        <div class="forum-heading">
            <h2>{{ $title }}</h2>
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
