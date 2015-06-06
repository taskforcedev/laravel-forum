<?php

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers'], function() {
    Route::get('forum', ['as' => 'forum.index', 'uses' => 'ForumController@index']);
});