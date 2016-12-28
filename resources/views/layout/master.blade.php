<!DOCTYPE html>
<html>
<head>
    <title>Laravel Forum</title>
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    @yield('head')
    @yield('styles')
</head>
<body>
    <div class="container">
        @yield('breadcrumbs')
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
