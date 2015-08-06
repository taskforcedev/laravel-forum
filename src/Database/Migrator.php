<?php namespace Taskforcedev\LaravelForum\Database;

use \Schema;

class Migrator
{
    public function migrate()
    {
        $this->migrateCategories();
        $this->migrateForums();
        $this->migratePosts();
        $this->migrateReplies();
        $this->addFieldsToForumPosts();
    }

    /**
     * Adds the Forum Category table.
     */
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

    /**
     * Adds the Forums Table
     */
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
                $table->boolean('sticky')->default(0);
                $table->boolean('locked')->default(0);
            });
        }
    }
}
