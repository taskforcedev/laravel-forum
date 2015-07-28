@extends($layout)

@section('content')
<form action="{{ route('laravel-forum.api.store.forum.post') }}" method="POST">
    <input class="form-control" type="text" name="title" id="title" />

    <textarea class="form-control" name="body" id="body">
    </textarea>

    <input type="hidden" name="forum_id" id="forum_id" value="{{ $forum_id }}" />

    <input type="submit" />

</form>
@stop
