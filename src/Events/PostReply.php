<?php namespace Taskforcedev\LaravelForum\Events;

use Illuminate\Queue\SerializesModels;
use Taskforcedev\LaravelForum\ForumPost;
use Taskforcedev\LaravelForum\ForumReply;

class PostReply extends Event
{
    use SerializesModels;

    public $user;
    public $reply;

    public function __construct(ForumReply $reply, $user)
    {
        $this->reply = reply;
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
