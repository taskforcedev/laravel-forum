@extends($layout)

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('laravel-forum.index') }}">Forums</a></li>
        <li class="active">{{ $forum->name }}</li>
    </ol>
@stop

@section('content')
    <h1>{{ $forum->name }} <a class="btn btn-sm btn-success pull-right" href="{{ route('laravel-forum.write.post', ['id' => $forum->id]) }}"><span class="glyphicon glyphicon-plus"></span> New Post</a></h1>

    <?php
        $posts = $forum->posts;
        $postCount = count($posts);
    ?>

    @if ($postCount > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>Replies</th>
                    <th>Latest Reply</th>
                </tr>
            </thead>
            <tbody>
        @foreach($posts as $post)
            <?php
                $locked = (bool)$post->locked;
                $sticky = (bool)$post->sticky;
                $replies = $post->replies;
                $replyCount = count($post->replies);
                $lastReply = $post->lastReply();
                if (isset($lastReply)) {
                    $replyAuthor = $lastReply['author'];
                    $replyDate = $lastReply['date'];
                }
            ?>
            <tr>
                <td>
                    @if ($locked)
                        Locked:
                    @elseif ($sticky)
                        Sticky:
                    @endif
                    <a href="{{ route('laravel-forum.view.post', ['id' => $forum->id, 'fid' => $post->id]) }}">{{ $post->title }}</a></td>
                <td>{{ $replyCount }}</td>
                @if (isset($lastReply))
                    <td>{{ $replyAuthor }} @ {{ $replyDate }}</td>
                @else
                    <td>No replies</td>
                @endif
            </tr>
        @endforeach
            </tbody>
        </table>
    @else
        <p>There are currently no posts in this forum</p>
    @endif
@stop
