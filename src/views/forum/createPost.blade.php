@extends($layout)

@section('content')
<h1>Writing post in {{ $forum->name }} Forum.</h1>
<form action="{{ route('laravel-forum.api.store.forum.post') }}" method="POST">
    <input class="form-control" type="text" name="title" id="title" />

    <textarea class="form-control" name="body" id="body">
    </textarea>

    <input type="hidden" name="forum_id" id="forum_id" value="{{ $forum->id }}" />

    <input type="submit" />

</form>
@stop
