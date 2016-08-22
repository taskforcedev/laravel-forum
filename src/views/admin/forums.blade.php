@extends($layout)

@section('content')
    <h1>Forum Administration</h1>

    <div class="alert" style="display: none;"></div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            @include('laravel-forum::admin/forum/_create')

            <div class="panel">
                <div class="panel-heading panel-primary">
                    <h2>Forums

                        @if(isset($categories) && !empty($categories))
                          <a href="" class="btn btn-sm glyphicon glyphicon-plus">Create Forum</a>
                        @endif

                    </h2>
                </div>

                <div class="panel-body">
                    @if(isset($forums) && !empty($forums))

                    <?php $prevCategory = ''; ?>

                    <ul class="list-group">

                        @foreach($forums as $forum)

                            @if ($forum->category !== $prevCategory)
                                <li class="list-group-item list-group-item-info">{{ $forum->category->name }} (Category)</li>
                            @endif
                            <li class="list-group-item">{{ $forum->name }}
                                <button class="btn btn-xs btn-danger pull-right" onclick="return deleteForum({{ $forum->id }})">Delete</button>
                            </li>

                            <?php $prevCategory = $forum->category; ?>

                        @endforeach

                    </ul>

                    @endif

                </div>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right">

            @include('laravel-forum::admin/_sidebar')

        </div>
    </div>

    <script type="application/javascript">
        var postdata = {
            "_method": "DELETE",
            "_token": "{{ csrf_token() }}"
        }

        function deleteForum(id)
        {
            postdata.forum_id = id;
            $.post("{{ route('laravel-forum.api.delete.forum') }}", postdata)
            .done(function() {
                window.location.reload();
            });
        }
    </script>
@stop
