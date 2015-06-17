<?php
$fields = [
    ['name' => 'name', 'type' => 'text'],
    ['name' => 'description', 'type' => 'text'],
    [
        'name' => 'category',
        'type' => 'select',
        'options' => $categories,
        'field' => 'name'
    ]
];
$data = [
    'item' => 'Forum',
    'fields' => $fields,
    'url' => URL::route('laravel-forum.api.store.forum'),
    'done' => "location.reload();",
];
?>
@include('laravel-forum::layout.bootstrap._createModal', $data)
