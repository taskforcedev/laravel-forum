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
    'item' => 'Category',
    'fields' => $fields,
    'url' => URL::route('laravel-forum.api.store.forum')
];
?>
@include('laravel-forum::layout.bootstrap._createModal', $data)
