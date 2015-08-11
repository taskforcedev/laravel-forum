<?php
    if (!isset($layout)) {
        $config = config('laravel-forum::layout');
        if (isset($config)) {
            $layout = $config;
        } else {
            $layout = 'laravel-forum::layout.master';
        }
    }
?>

@extends($layout)

@section('content')
    <h1>404</h1>

    The page you are looking for could not be found, why not go back to the <a href="{{ route('laravel-forum.index') }}">forum</a>?
@stop
