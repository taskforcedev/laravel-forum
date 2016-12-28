@extends($layout)

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="active">Forums</li>
    </ol>
@stop

@section('content')
    <h1>{{ $sitename or 'Laravel' }} - Forums</h1>
    <div class="forums">
    @if(isset($categories) && !empty($categories))
        <table class="table forum-category">
        @foreach($categories as $cat)
                <thead>
                    <tr>
                        <th>{{ $cat->name }}</th>
                        <th>Posts</th>
                    </tr>
                </thead>
                @foreach($cat->forums as $forum)
                    <tr class="forum">
                        <td><a href="{{ route('laravel-forum.view', ['id' => $forum->id]) }}">{{ $forum->name }}</a>
                        @if(isset($forum->description) && !empty($forum->description))
                        <small> - {{ $forum->description }}</small>
                        @endif
                        </td>
                        <td>{{ $forum->getThreadCount() }}</td>
                    </tr>
                @endforeach
        @endforeach
        </table>
    @else
        <p>You have no forum categories yet.</p>
    @endif
    </div>
@stop
