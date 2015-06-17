<?php
$fields = [
    ['name' => 'name', 'type' => 'text'],
];
$data = [
    'item' => 'Category',
    'fields' => $fields,
    'url' => URL::route('laravel-forum.api.store.forum.category')
];
?>
@include('layout.bootstrap._createModal', $data)
