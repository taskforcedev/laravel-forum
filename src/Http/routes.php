<?php

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers'], function() {
    Route::get('forum', ['as' => 'forum.index', 'uses' => 'ForumController@index']);


    Route::group(['prefix' => 'admin'], function() {
        Route::get('forum',            ['as' => 'forum.admin.index', 'uses' => 'AdminController@index']);
        Route::get('forum/forums',     ['as' => 'forum.admin.forums', 'uses' => 'AdminController@forums']);
        Route::get('forum/categories', ['as' => 'forum.admin.categories', 'uses' => 'AdminController@categories']);
    });

    Route::group(['prefix' => 'api'], function() {
        Route::post('forum_category', ['as' => 'api.store.forum.category', 'uses' => 'ApiController@forumCategoryStore']);
        Route::post('forum',          ['as' => 'api.store.forum',          'uses' => 'ApiController@forumStore']);
        Route::post('forum_post',     ['as' => 'api.store.forum.post',     'uses' => 'ApiController@forumStore']);
        Route::post('forum_reply',    ['as' => 'api.store.forum.reply',    'uses' => 'ApiController@forumStore']);
    });
});