<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    public $table = 'forum_categories';

    public $fillable = ['name'];
}
