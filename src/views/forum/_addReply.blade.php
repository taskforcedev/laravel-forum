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
@if (\Auth::check())
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Reply</h2>

        @if (isset($wysiwygInclude))
            @if (isset($js))
                <script src="{{ $js }}"></script>
            @endif
        @endif
        <textarea class="form-control"></textarea>
        @if (isset($wysiwygInclude))
            <script type="application/javascript">
                <?=$init;?>
            </script>
        @endif
    </div>
@endif
