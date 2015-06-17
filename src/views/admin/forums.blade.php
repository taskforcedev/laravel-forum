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
                            <button class="btn-primary btn btn-sm pull-right"

                            @if (isset($modalType) && $modalType == 'bootstrap')
                                data-toggle="modal"
                                data-target="#createForumModal"
                            @else
                                id="createForum"
                            @endif

                            ><span class="glyphicon glyphicon-pencil"></span> Create Forum</button>
                        @else
                            <button class="btn btn-sm pull-right disabled"><span class="glyphicon glyphicon-pencil"></span> Create Forum</button>
                        @endif

                    </h2>
                </div>
                <div class="panel-body">

                    @if(isset($forums) && !empty($forums))
                        <ul class="list-group">
                            @foreach($forums as $forum)
                                <div class="forum category"></div>
                                <li class="list-group-item">{{ $forum->name }} <span class="badge">{{ $forum->category }}</span></li>
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

@stop