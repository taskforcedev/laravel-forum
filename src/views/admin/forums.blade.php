@extends($layout)

@section('content')
    <h1>Forum Administration - Forums</h1>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            <h2>Forums</h2>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            @include('laravel-forum::admin/_sidebar')

        </div>
    </div>
@stop