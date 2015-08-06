<?php

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers'], function() {
    // Public Routes
    Route::get('forum/{id}/post/{pid}', [ 'as' => 'laravel-forum.view.post',  'uses' => 'ForumController@viewPost'   ]);
    Route::get('forum/{id}/post',       [ 'as' => 'laravel-forum.write.post', 'uses' => 'ForumController@createPost' ]);
    Route::get('forum/{id}',            [ 'as' => 'laravel-forum.view',       'uses' => 'ForumController@view'       ]);
    Route::get('forum',                 [ 'as' => 'laravel-forum.index',      'uses' => 'ForumController@index'      ]);

    // Admin Routes.
    Route::group(['prefix' => 'admin'], function() {
        Route::get('forum',            [ 'as' => 'laravel-forum.admin.index',      'uses' => 'AdminController@index'      ]);
        Route::get('forum/forums',     [ 'as' => 'laravel-forum.admin.forums',     'uses' => 'AdminController@forums'     ]);
        Route::get('forum/categories', [ 'as' => 'laravel-forum.admin.categories', 'uses' => 'AdminController@categories' ]);
    });

    // Api Routes.
    Route::group(['prefix' => 'api'], function() {
        Route::post('forum_category', [ 'as' => 'laravel-forum.api.store.forum.category', 'uses' => 'ApiController@forumCategoryStore' ]);
        Route::post('forum',          [ 'as' => 'laravel-forum.api.store.forum',          'uses' => 'ApiController@forumStore'         ]);
        Route::post('forum_post',     [ 'as' => 'laravel-forum.api.store.forum.post',     'uses' => 'ApiController@forumPostStore'     ]);
        Route::post('forum_reply',    [ 'as' => 'laravel-forum.api.store.forum.reply',    'uses' => 'ApiController@forumReplyStore'    ]);
        Route::delete('forum_post',   [ 'as' => 'laravel-forum.api.delete.forum.post',    'uses' => 'ApiController@forumPostDelete'    ]);

        Route::post('post/sticky/{id}', [ 'as' => 'laravel-forum.api.post.sticky', 'uses' => 'ApiController@stickyPost' ]);
        Route::post('post/lock/{id}',   [ 'as' => 'laravel-forum.api.post.lock',   'uses' => 'ApiController@lockPost'   ]);

        Route::post('post/unsticky/{id}', [ 'as' => 'laravel-forum.api.post.unsticky', 'uses' => 'ApiController@unstickyPost' ]);
        Route::post('post/unlock/{id}',   [ 'as' => 'laravel-forum.api.post.unlock',   'uses' => 'ApiController@unlockPost'   ]);
    });
});
