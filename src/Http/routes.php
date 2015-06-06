<?php

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers'], function() {
    Route::get('forum', ['as' => 'forum.index', 'uses' => 'ForumController@index']);

    Route::get('teamspeak', function () {
        return \Redirect::route('voip.index');
    });

    Route::get('ventrilo', function () {
        return \Redirect::route('voip.index');
    });

    Route::get('mumble', function () {
        return \Redirect::route('voip.index');
    });
});