<?php
    if(isset($wysiwyg)) {
        $wysiwygInclude = $wysiwyg['include'];

        switch ($wysiwyg['name']) {
            case 'tinymce':
                $js = '//tinymce.cachefly.net/4.2/tinymce.min.js';
                $css = null;
                $init = "tinymce.init({selector:'textarea'});";
                break;
            default:
                $js = '//tinymce.cachefly.net/4.2/tinymce.min.js';
                $css = null;
                $init = "tinymce.init({selector:'textarea'});";
                break;
        }
    }
?>
@if (\Auth::check())
    <form method="POST" action="{{ route('laravel-forum.api.store.forum.reply') }}">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Reply</h2>

        @if (isset($wysiwygInclude))
            @if (isset($js))
                <script src="{{ $js }}"></script>
            @endif
        @endif
        <textarea name="body" class="form-control"></textarea>
        @if (isset($wysiwygInclude))
            <script type="application/javascript">
                <?=$init;?>
            </script>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="forum_id" value="{{ $forum->id }}" />
        <input type="hidden" name="post_id" value="{{ $post->id }}" />

        <input class="btn btn-primary" type="submit" value="Reply" />
    </div>
    </form>
@endif
