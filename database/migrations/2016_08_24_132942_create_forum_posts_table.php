<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumPostsTable extends Migration
{
    public function up()
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

    public function down()
    {
        Schema::dropIfExists('forum_posts');
    }
}
