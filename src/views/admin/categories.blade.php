@extends($layout)

@section('content')
    <h1>Forum Administration</h1>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            @include('laravel-forum::admin/category/_create')

            <div class="panel">
                <div class="panel-heading panel-primary">
                    <h2>Categories <button class="btn-primary btn btn-sm pull-right"
                        @if (isset($modalType) && $modalType == 'bootstrap')
                            data-toggle="modal"
                            data-target="#createCategoryModal"
                        @else
                            id="createCategory"
                        @endif
                    ><span class="glyphicon glyphicon-plus"></span> Create Category</button>
                    </h2>
                </div>
                <div class="panel-body">

                    @if(isset($categories) && !empty($categories))
                        <ul class="list-group">
                        @foreach($categories as $cat)
                            <div class="forum category"></div>
                                <li class="list-group-item">{{ $cat->name }} <button class="btn btn-xs btn-danger pull-right">Delete</button></li>
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
