<?php

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers', 'middleware' => 'web'], function() {
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

});

Route::group(['namespace' => 'Taskforcedev\LaravelForum\Http\Controllers', 'middleware' => 'api'], function() {

  Route::group(['prefix' => 'api'], function() {
      /* Forum Category */
      Route::post('forum_category',   [ 'as' => 'laravel-forum.api.store.forum.category',  'uses' => 'ApiController@forumCategoryStore'  ]);
      Route::delete('forum_category', [ 'as' => 'laravel-forum.api.delete.forum.category', 'uses' => 'ApiController@forumCategoryDelete' ]);

      /* Forum */
      Route::post('forum',   [ 'as' => 'laravel-forum.api.store.forum',  'uses' => 'ApiController@forumStore'  ]);
      Route::delete('forum', [ 'as' => 'laravel-forum.api.delete.forum', 'uses' => 'ApiController@forumDelete' ]);

      /* Forum Post */
      Route::post('forum_post',              [ 'as' => 'laravel-forum.api.store.forum.post',  'uses' => 'ApiController@forumPostStore' ]);
      Route::delete('forum/{id}/post/{pid}', [ 'as' => 'laravel-forum.api.delete.forum.post', 'uses' => 'ApiController@postDelete'     ]);
      /* Forum Post: Reply */
      Route::post('forum_reply', [ 'as' => 'laravel-forum.api.store.forum.reply', 'uses' => 'ApiController@forumReplyStore' ]);

      /* Lock Forum Post */
      Route::post('post/unlock/{id}', [ 'as' => 'laravel-forum.api.post.unlock', 'uses' => 'ApiController@unlockPost' ]);
      Route::post('post/lock/{id}',   [ 'as' => 'laravel-forum.api.post.lock',   'uses' => 'ApiController@lockPost'   ]);

      /* Sticky Forum Post */
      Route::post('post/sticky/{id}',   [ 'as' => 'laravel-forum.api.post.sticky',   'uses' => 'ApiController@stickyPost'   ]);
      Route::post('post/unsticky/{id}', [ 'as' => 'laravel-forum.api.post.unsticky', 'uses' => 'ApiController@unstickyPost' ]);
  });

});
