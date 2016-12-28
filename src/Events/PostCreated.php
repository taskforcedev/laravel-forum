<?php namespace Taskforcedev\LaravelForum\Events;

use Illuminate\Queue\SerializesModels;
use Taskforcedev\LaravelForum\Models\ForumPost;

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

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['laravel-forum'];
    }
}
