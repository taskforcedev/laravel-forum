<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    public function up()
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

    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
