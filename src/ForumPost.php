<?php namespace Taskforcedev\LaravelForum;

/**
 * Class ForumPost
 *
 * @property string  $title
 * @property string  $body
 * @property integer $forum_id
 * @property integer $author_id
 *
 * @package Taskforcedev\LaravelForum
 */
class ForumPost extends AbstractModel
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
