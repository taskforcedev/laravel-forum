<!DOCTYPE html>
<html>
<head>
    <title>Laravel Forum</title>
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('breadcrumbs')
        @yield('content')
    </div>
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
    @yield('scripts')
</body>
</html>
