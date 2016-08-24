<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostsAddStickyAndLocked extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('forum_posts', 'sticky') && !Schema::hasColumn('forum_posts', 'locked')) {
            Schema::table('forum_posts', function ($table) {
                $table->boolean('sticky')->default(0);
                $table->boolean('locked')->default(0);
            });
        }
    }

    public function down()
    {
        Schema::table('forum_posts', function ($table) {
            $table->dropColumn(['sticky', 'locked']);
        });
    }
}
