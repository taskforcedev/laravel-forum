<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Schema;
use Taskforcedev\LaravelForum\Forum;
use Taskforcedev\LaravelForum\ForumCategory;

/**
 * Class AdminController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class AdminController extends BaseController
{
    /**
     * Admin index.
     * @return mixed
     */
    public function index()
    {
        $install = $this->installation();
        if ($install) {
            return $install;
        }

        if (!$this->canAdministrate()) {
            return \Redirect::route('forum.index');
        }

        $data = $this->buildData();
        return view('laravel-forum::admin/index', $data);
    }

    /**
     * @return mixed
     */
    public function forums()
    {
        if (!$this->canAdministrate()) {
            return \Redirect::route('forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        $data['forums'] = Forum::all();
        return view('laravel-forum::admin/forums', $data);
    }

    /**
     * @return mixed
     */
    public function categories()
    {
        if (!$this->canAdministrate()) {
            return \Redirect::route('forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        return view('laravel-forum::admin/categories', $data);
    }

    /**
     * @return array
     */
    public function buildData()
    {
        return [
            'user' => $this->getUser(),
            'modalType' => $this->getModalType(),
            'layout' => config('laravel-forum.layout'),
        ];
    }

    public function installation()
    {
        $this->migrate();

        if (!Schema::hasTable('forums')) {
            return 'Laravel Forums: Error: Unable to migrate tables.';
        }

        return false;
    }

    /**
     * Creates the required database tables
     */
    public function migrate()
    {
        $this->migrateCategories();
        $this->migrateForums();
        $this->migratePosts();
        $this->migrateReplies();
        $this->addFieldsToForumPosts();
    }

    public function migrateCategories()
    {
        if (!Schema::hasTable('forum_categories')) {
            Schema::create('forum_categories', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            });
        }
    }

    public function migrateForums()
    {
        if (!Schema::hasTable('forums')) {
            Schema::create('forums', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->integer('category_id')->unsigned();
                $table->foreign('category_id')
                    ->references('id')->on('forum_categories')
                    ->onDelete('cascade');
                $table->integer('public')->default(1);
                $table->timestamps();
            });
        }
    }

    public function migratePosts()
    {
        if (!Schema::hasTable('forum_posts')) {
            Schema::create('forum_posts', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->string('body', 4000);
                $table->integer('forum_id')->unsigned();
                $table->foreign('forum_id')
                    ->references('id')->on('forums')
                    ->onDelete('cascade');
                $table->integer('author_id');
                $table->timestamps();
            });
        }
    }

    public function migrateReplies()
    {
        if (!Schema::hasTable('forum_post_replies')) {
            Schema::create('forum_post_replies', function ($table) {
                $table->increments('id');
                $table->string('body', 4000);
                $table->integer('post_id')->unsigned();
                $table->foreign('post_id')
                    ->references('id')->on('forum_posts')
                    ->onDelete('cascade');
                $table->integer('author_id');
                $table->timestamps();
            });
        }
    }

    public function addFieldsToForumPosts()
    {
        if (!Schema::hasColumn('forum_posts', 'sticky') && !Schema::hasColumn('forum_posts', 'locked')) {
            Schema::table('forum_posts', function ($table) {
                $table->boolean('sticky');
                $table->boolean('locked');
            });
        }
    }
}
