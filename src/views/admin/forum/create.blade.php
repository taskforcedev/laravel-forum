@extends($layout)

@section('content')

<div class="row">
    <h2>Create Forum</h2>

    @if (isset($categories) && count($categories) > 0)

        <form action="{{ route('laravel-forum.api.store.forum') }}">
          <div class="form-group">
            <label for="name">Forum Name</label>
            <input type="text" name="name" class="form-control" />
          </div>

          <div class="form-group">
            <label for="name">Forum Description</label>
            <input type="text" name="description" class="form-control" />
          </div>


          <div class="form-group">
          <label for="category">Forum Description</label>
          <select name="category" class="form-control">
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
          </div>
          {{ csrf_field() }}

          <button type="submit" class="btn btn-s">Submit</button>
        </form>

    @else

        <p>You cannot add a forum until you have first added some <a href="{{ route('laravel-forum.admin.category.create') }}">Forum Categories</a>.</p>

    @endif

</div>
@stop
