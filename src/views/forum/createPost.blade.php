<?php
    if(isset($wysiwyg)) {
        $wysiwygInclude = $wysiwyg['include'];

        switch ($wysiwyg['name']) {
            case 'tinymce':
                $js = '//tinymce.cachefly.net/4.2/tinymce.min.js';
                $css = null;
                $init = "tinymce.init({selector:'textarea'});";
        }
    }
?>

@extends($layout)

@section('content')
<h1>Writing post in {{ $forum->name }} Forum. <span class="pull-right"><a class="btn btn-info" href="{{ route('laravel-forum.view', $forum->id) }}">Back</a></span></h1>
<form action="{{ route('laravel-forum.api.store.forum.post') }}" method="POST">

    <label>Post Title</label>
    <input class="form-control" type="text" name="title" id="title" />

    @if (isset($wysiwygInclude))
        @if (isset($js))
            <script src="{{ $js }}"></script>
        @endif
    @endif

    <label>Body</label>
    <textarea class="form-control" name="body" id="body" rows="20">
    </textarea>

    @if (isset($wysiwygInclude))
        <script type="application/javascript">
            <?=$init;?>
        </script>
    @endif

    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="forum_id" id="forum_id" value="{{ $forum->id }}" />

    <input type="submit" class="btn btn-success" />

</form>
@stop
