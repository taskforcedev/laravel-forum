@extends($layout)

@section('content')
    <h1>{{ $sitename or 'Laravel' }} Forums</h1>

    @if(isset($categories) && !empty($categories))
        <table class="table">
        @foreach($categories as $cat)
                <thead>
                    <tr>
                        <th>{{ $cat->name }}</th>
                        <th>Posts</th>
                    </tr>
                </thead>
                @foreach($cat->forums as $forum)
                    <tr class="forum">
                        <td>{{ $forum->name }}</td>
                        <td>{{ $forum->getThreadCount() }}</td>
                    </tr>
                @endforeach
        @endforeach
        </table>
    @else
        You have no forum categories yet.
    @endif
@stop