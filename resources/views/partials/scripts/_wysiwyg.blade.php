@if (isset($wysiwyg))
    @if ($wysiwyg['include'] === true)
        @if ($wysiwyg['name'] === 'tinymce')
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        @endif
    @endif
    @if ($wysiwyg['name'] === 'tinymce')
        <script>
            tinymce.init({ selector:'.wysiwyg' });
        </script>
    @endif
@endif