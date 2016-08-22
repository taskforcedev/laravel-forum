<?php
$fields = [
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
    'url' => route('laravel-forum.api.store.forum'),
    'done' => "location.reload();",
];
?>

<h2>Create Forum</h2>

<label for="name">Forum Name</label>
<input type="text" name="name" />

<label for="name">Forum Description</label>
<input type="text" name="description" />

@if (isset($categories))
<select name="category">
  @foreach ($categories as $cat)
    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
  @endforeach
</select>
@endif
