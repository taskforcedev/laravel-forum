@extends($layout)

@section('breadcrumbs')
<?php
    $forum = $post->forum;
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2>{{ $title }}</h2>
            By {{ $post->author->name }} @ {{ $post->created_at }}

            @if (method_exists($user, 'can') && ($user->can('forum-administrate') || $user->can('forum-moderate')))
                <script type="application/javascript">
                    var data = {
                        "sticky_url": "{{ route('laravel-forum.api.post.sticky', $post->id) }}",
                        "unsticky_url": "{{ route('laravel-forum.api.post.unsticky', $post->id) }}",
                        "lock_url": "{{ route('laravel-forum.api.post.lock', $post->id) }}",
                        "unlock_url": "{{ route('laravel-forum.api.post.unlock', $post->id) }}",
                        "delete_url": "",
                    }

                    var postdata = {
                        "_token": "{{ csrf_token() }}"
                    }

                    function stickyPost()
                    {
                        $.post( data.sticky_url, postdata)
                        .done(function() {
                            window.location.reload();
                        });
                    }

                    function unstickyPost()
                    {
                        $.post( data.unsticky_url, postdata)
                        .done(function() {
                            window.location.reload();
                        });
                    }

                    function lockPost()
                    {
                        $.post( data.lock_url, postdata)
                        .done(function() {
                            window.location.reload();
                        });
                    }

                    function unlockPost()
                    {
                        $.post( data.unlock_url, postdata)
                        .done(function() {
                            window.location.reload();
                        });
                    }

                    function deletePost()
                    {
                        $confirm = confirm('Are you sure you wish to delete this thread? This cannot be undone.');

                        if ($confirm) {
                            $.post( data.delete_url, postdata)
                            .done(function() {
                                window.location.reload();
                            });
                        }
                    }
                </script>
                <span class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Actions</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    @if ($sticky)
                        <li><a onclick="return unstickyPost();"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Unsticky</a></li>
                    @else
                        <li><a onclick="return stickyPost();"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Sticky</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    @if ($locked)
                        <li><a onclick="return unlockPost();"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Unlock</a></li>
                    @else
                        <li><a onclick="return lockPost();"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Lock</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    <li><a onclick="return deletePost();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a></li>
                </ul>
            </div>
        </span>
            @endif
        </div>
        <div class="panel-body">
            <div class="row forum-post">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg2" style="border-right: 1px solid #333">
                    Author: {{ $post->author->name }}
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    {!! nl2br(e($post->body)) !!}
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

            <div class="panel panel-info">
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

    @include('laravel-forum::forum/_addReply')
@stop
