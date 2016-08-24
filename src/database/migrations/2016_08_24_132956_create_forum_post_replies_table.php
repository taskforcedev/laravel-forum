<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumPostRepliesTable extends Migration
{
    public function up()
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

    public function down()
    {
        Schema::dropIfExists('forum_post_replies');
    }
}
