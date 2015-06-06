<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    public $table = 'forum_posts';

    public $fillable = ['title', 'body', 'forum_id', 'author_id'];

    public function author()
    {
        return $this->belongsTo('User');
    }

    public function forum()
    {
        return $this->belongsTo('Forum');
    }

    public function replies()
    {
        return $this->hasMany('ForumReply');
    }
}
