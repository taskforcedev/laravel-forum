@extends($layout)

@section('content')
<?php

    $widgets = [

        'forum' => [
            'count' => $counts['forum'],
            'class' => 'bg-info',
            'title' => 'Forums',
            'size' => 2,
        ],

        'category' => [
            'count' => $counts['category'],
            'class' => 'bg-primary',
            'title' => 'Categories',
            'size' => 2,
        ],

        'post' => [
            'count' => $counts['post'],
            'class' => 'bg-success',
            'title' => 'Posts',
            'size' => 2,
        ],

        'reply' => [
            'count' => $counts['reply'],
            'class' => 'bg-warning',
            'title' => 'Replies',
            'size' => 2,
        ]

    ]

?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            <h1>Forum Administration</h1>

            <p>Please use the navigation on the right to manage forums and categories.</p>

            <div class="row">

            <!-- Include item counts here -->
            @include('laravel-forum::admin.widgets._widget', $widgets['category'])

            @include('laravel-forum::admin.widgets._widget', $widgets['forum'])

            @include('laravel-forum::admin.widgets._widget', $widgets['post'])

            @include('laravel-forum::admin.widgets._widget', $widgets['reply'])

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            @include('laravel-forum::admin._sidebar')

        </div>
    </div>
@stop
