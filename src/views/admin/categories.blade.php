@extends($layout)

@section('content')
    <h1>Forum Administration</h1>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            @include('laravel-forum::admin/category/_create')

            <div class="panel">
                <div class="panel-heading panel-primary">
                    <h2>Categories <button class="btn-primary btn btn-sm pull-right"

                      @if(isset($categories) && !empty($categories))
                        <a href="" class="btn btn-sm glyphicon glyphicon-plus">Create Category</a>
                      @endif

                    </h2>
                </div>
                <div class="panel-body">

                    @if(isset($categories) && !empty($categories))
                        <ul class="list-group">
                        @foreach($categories as $cat)
                            <div class="forum category"></div>
                                <li class="list-group-item">{{ $cat->name }} <button class="btn btn-xs btn-danger pull-right" onclick="deleteCategory({{ $cat->id }})">Delete</button></li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            @include('laravel-forum::admin/_sidebar')

        </div>
    </div>

    <script type="application/javascript">
        var postdata = {
            "_method": "DELETE",
            "_token": "{{ csrf_token() }}"
        }

        function deleteCategory(id)
        {
            postdata.category_id = id;
            $.post("{{ route('laravel-forum.api.delete.forum.category') }}", postdata)
            .done(function() {
                window.location.reload();
            });
        }
    </script>

@stop
