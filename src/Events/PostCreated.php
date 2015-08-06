<?php namespace Taskforcedev\LaravelForum\Events;

use Illuminate\Queue\SerializesModels;
use Taskforcedev\LaravelForum\ForumPost;

class PostCreated extends Event
{
    use SerializesModels;

    public $user;
    public $post;

    public function __construct(ForumPost $post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }
}
